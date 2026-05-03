const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();
app.use(cors());

const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    }
});

const dbConfig = {
    host: '127.0.0.1',
    user: 'root',
    password: '',
    database: 'lexaid_cse470'
};

io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    // Client-Lawyer case chat room
    socket.on('joinCaseRoom', (caseId) => {
        socket.join(`case_${caseId}`);
        console.log(`Socket ${socket.id} joined case_${caseId}`);
    });

    socket.on('sendMessage', async (data) => {
        try {
            const { case_id, sender_id, receiver_id, message } = data;

            if (!case_id || !sender_id || !receiver_id || !message) {
                socket.emit('chatError', 'Missing message data.');
                return;
            }

            const connection = await mysql.createConnection(dbConfig);

            const [result] = await connection.execute(
                `INSERT INTO chat_messages (case_id, sender_id, receiver_id, message, created_at)
                 VALUES (?, ?, ?, ?, NOW())`,
                [case_id, sender_id, receiver_id, message]
            );

            await connection.end();

            const savedMessage = {
                id: result.insertId,
                case_id,
                sender_id,
                receiver_id,
                message,
                created_at: new Date().toISOString()
            };

            io.to(`case_${case_id}`).emit('receiveMessage', savedMessage);
        } catch (error) {
            console.error('Case message save error:', error);
            socket.emit('chatError', 'Message could not be saved.');
        }
    });

    // Admin-Lawyer direct chat room
    socket.on('joinAdminLawyerRoom', (data) => {
        const { lawyer_id } = data;

        if (!lawyer_id) {
            socket.emit('adminLawyerChatError', 'Missing lawyer room data.');
            return;
        }

        socket.join(`lawyer_${lawyer_id}`);
        console.log(`Socket ${socket.id} joined lawyer_${lawyer_id}`);
    });

    socket.on('sendAdminLawyerMessage', async (data) => {
        try {
            const { admin_id, lawyer_id, sender_id, message } = data;

            if (!admin_id || !lawyer_id || !sender_id || !message) {
                socket.emit('adminLawyerChatError', 'Missing message data.');
                return;
            }

            const connection = await mysql.createConnection(dbConfig);

            const [result] = await connection.execute(
                `INSERT INTO admin_lawyer_messages (admin_id, lawyer_id, sender_id, message, created_at)
                 VALUES (?, ?, ?, ?, NOW())`,
                [admin_id, lawyer_id, sender_id, message]
            );

            await connection.end();

            const savedMessage = {
                id: result.insertId,
                admin_id,
                lawyer_id,
                sender_id,
                message,
                created_at: new Date().toISOString()
            };

            io.to(`lawyer_${lawyer_id}`).emit('receiveAdminLawyerMessage', savedMessage);
        } catch (error) {
            console.error('Admin-lawyer message save error:', error);
            socket.emit('adminLawyerChatError', 'Admin-lawyer message could not be saved.');
        }
    });

    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });
});

server.listen(3000, () => {
    console.log('Socket.IO chat server running on http://localhost:3000');
});