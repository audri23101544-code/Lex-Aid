<!DOCTYPE html>
<html class="light" lang="en">
<head>
    
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LexAid | Digital Magistrate Admin</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Manrope:wght@200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "inverse-primary": "#aec7f6",
                        "background": "#f8f9fa",
                        "tertiary": "#000a1e",
                        "on-tertiary-container": "#708ab5",
                        "on-primary-fixed": "#001b3d",
                        "on-tertiary-fixed-variant": "#2d476f",
                        "on-surface": "#191c1d",
                        "outline": "#74777f",
                        "on-tertiary-fixed": "#001b3c",
                        "surface-tint": "#465f88",
                        "secondary-fixed-dim": "#eac243",
                        "surface-container-low": "#f3f4f5",
                        "on-secondary": "#ffffff",
                        "inverse-on-surface": "#f0f1f2",
                        "surface-container": "#edeeef",
                        "on-secondary-container": "#725a00",
                        "tertiary-container": "#002147",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "tertiary-fixed": "#d6e3ff",
                        "outline-variant": "#c4c6cf",
                        "on-secondary-fixed": "#241a00",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface": "#f8f9fa",
                        "secondary-fixed": "#ffe089",
                        "secondary": "#745b00",
                        "tertiary-fixed-dim": "#adc7f7",
                        "surface-variant": "#e1e3e4",
                        "primary-fixed-dim": "#aec7f6",
                        "on-primary-fixed-variant": "#2d476f",
                        "on-primary-container": "#708ab5",
                        "surface-bright": "#f8f9fa",
                        "secondary-container": "#fcd353",
                        "on-background": "#191c1d",
                        "primary-container": "#002147",
                        "error": "#ba1a1a",
                        "surface-dim": "#d9dadb",
                        "inverse-surface": "#2e3132",
                        "surface-container-highest": "#e1e3e4",
                        "primary": "#000a1e",
                        "primary-fixed": "#d6e3ff",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#e7e8e9",
                        "on-surface-variant": "#44474e",
                        "on-secondary-fixed-variant": "#574500"
                    },
                    fontFamily: {
                        "headline": ["Newsreader"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Manrope', sans-serif; }
        h1, h2, h3 { font-family: 'Newsreader', serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface text-primary">

<aside class="bg-[#002147] h-screen w-64 fixed left-0 top-0 overflow-y-auto flex flex-col border-r border-white/5 shadow-2xl z-50">
    <div class="p-6">
        <div class="text-2xl font-serif italic text-white mb-1">LexAid</div>
        <div class="text-xs font-label text-[#FCD353] uppercase tracking-widest opacity-80">Digital Magistrate</div>
    </div>

    <nav class="flex-1 mt-4 space-y-1">
        <a class="flex items-center space-x-3 px-4 py-3 text-[#FCD353] bg-white/10 rounded-lg mx-2 scale-95 transition-transform" href="/admin">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label">Dashboard</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="/cases">
            <span class="material-symbols-outlined">folder_open</span>
            <span class="font-label">Case Files</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
            <span class="material-symbols-outlined">description</span>
            <span class="font-label">Documents</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
            <span class="material-symbols-outlined">calendar_today</span>
            <span class="font-label">Calendar</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
            <span class="material-symbols-outlined">chat_bubble</span>
            <span class="font-label">Messages</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label">Settings</span>
        </a>
    </nav>

    <div class="p-4">
        <a href="/case/create" class="w-full bg-secondary-container text-on-secondary-container py-3 rounded-xl font-semibold flex items-center justify-center space-x-2 shadow-lg active:scale-95 transition-transform">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>New Case</span>
        </a>
    </div>

    <div class="mt-auto p-4 border-t border-white/5 space-y-1">
        <a class="flex items-center space-x-3 px-4 py-2 text-slate-400 hover:text-white transition-colors" href="#">
            <span class="material-symbols-outlined">help_outline</span>
            <span class="font-label text-sm">Support</span>
        </a>
        <a class="flex items-center space-x-3 px-4 py-2 text-slate-400 hover:text-white transition-colors" href="/logout">
            <span class="material-symbols-outlined">logout</span>
            <span class="font-label text-sm">Logout</span>
        </a>
    </div>
</aside>

<header class="fixed top-0 right-0 w-[calc(100%-16rem)] h-16 z-40 bg-white/85 backdrop-blur-md flex items-center justify-between px-8 border-b border-slate-100">
    <div class="flex items-center space-x-8">
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <span class="material-symbols-outlined text-sm">search</span>
            </span>
            <input class="bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 text-sm w-64 focus:ring-2 focus:ring-primary-container transition-all" placeholder="Search cases, lawyers, or documents..." type="text"/>
        </div>
        <nav class="hidden md:flex items-center space-x-6 text-sm">
            <a class="text-[#002147] font-semibold border-b-2 border-[#745B00] pb-1" href="#">My Tasks</a>
            <a class="text-slate-500 hover:text-[#002147] transition-colors pb-1" href="#">Recent Cases</a>
        </nav>
    </div>

    <div class="flex items-center space-x-4">
        <button class="bg-primary-container text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 active:scale-95 transition-all">
            Quick Action
        </button>

        <div class="flex items-center space-x-2 text-slate-600">
            <button class="p-2 hover:bg-slate-100 rounded-full transition-colors relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
            </button>
            <button class="p-2 hover:bg-slate-100 rounded-full transition-colors">
                <span class="material-symbols-outlined">account_balance</span>
            </button>
        </div>

        <div class="text-sm font-medium text-slate-700">
            {{ $user->name }}
        </div>
    </div>
</header>

<main class="ml-64 pt-24 p-8 min-h-screen">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-headline text-primary mb-2">System Oversight</h1>
            <p class="text-on-surface-variant font-body">Administrative overview of LexAid ecosystem performance and resource allocation.</p>
        </div>
        <div class="flex items-center space-x-2 text-sm font-label text-on-surface-variant">
            <span class="material-symbols-outlined text-xs">schedule</span>
            <span>Logged in as Admin</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-primary-container bg-primary-fixed p-2 rounded-lg">gavel</span>
                </div>
                <div class="text-3xl font-headline text-primary">{{ $totalCases }}</div>
                <div class="text-sm font-label text-on-surface-variant">Total Active Cases</div>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-secondary bg-secondary-fixed p-2 rounded-lg">group</span>
                </div>
                <div class="text-3xl font-headline text-primary">{{ $totalUsers }}</div>
                <div class="text-sm font-label text-on-surface-variant">Total Users</div>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-tertiary bg-tertiary-fixed p-2 rounded-lg">badge</span>
                </div>
                <div class="text-3xl font-headline text-primary">{{ $totalLawyers }}</div>
                <div class="text-sm font-label text-on-surface-variant">Registered Lawyers</div>
            </div>
        </div>

        <div class="bg-primary-container p-6 rounded-xl shadow-2xl flex flex-col justify-between text-white">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-[#FCD353]">verified_user</span>
                    <span class="text-[10px] tracking-widest uppercase font-bold opacity-60">System Security</span>
                </div>
                <div class="text-3xl font-headline text-[#FCD353]">99.9%</div>
                <div class="text-sm font-label opacity-80">Audit Compliance Score</div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded shadow mt-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-bold text-red-600">Emergency SOS Requests</h2>
            <p class="text-gray-600">Latest urgent legal requests from clients</p>
        </div>

        <a href="/admin/sos" class="bg-red-600 text-white px-4 py-2 rounded">
            View All SOS
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-red-100 p-4 rounded">
            <h3 class="font-bold text-red-700">Total SOS</h3>
            <p class="text-3xl font-bold">{{ $totalSos ?? 0 }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded">
            <h3 class="font-bold text-yellow-700">Pending SOS</h3>
            <p class="text-3xl font-bold">{{ $pendingSos ?? 0 }}</p>
        </div>
    </div>

    @if(isset($sosRequests) && $sosRequests->count() > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-red-100">
                    <th class="border p-2">Client</th>
                    <th class="border p-2">Type</th>
                    <th class="border p-2">Location</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sosRequests as $sos)
                    <tr>
                        <td class="border p-2">{{ $sos->client_name }}</td>
                        <td class="border p-2">{{ $sos->emergency_type }}</td>
                        <td class="border p-2">{{ $sos->location }}</td>
                        <td class="border p-2">{{ $sos->phone }}</td>
                        <td class="border p-2 font-bold">{{ ucfirst($sos->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="bg-gray-100 p-4 rounded">
            No SOS requests yet.
        </div>
    @endif
</div>
    <div class="mt-12 bg-white rounded-xl shadow-sm border border-outline-variant/5 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-surface-container-lowest">
            <div>
                <h3 class="text-2xl font-headline text-primary">Recent Cases</h3>
                <p class="text-sm text-on-surface-variant font-body">Latest submitted cases in the system.</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-[10px] uppercase tracking-widest text-on-surface-variant font-bold">
                    <th class="px-8 py-4">ID</th>
                    <th class="px-8 py-4">Title</th>
                    <th class="px-8 py-4">Type</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4">Priority</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($recentCases as $case)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 font-label text-sm font-bold text-primary-container">#{{ $case->id }}</td>
                        <td class="px-8 py-5 text-sm font-medium">{{ $case->title }}</td>
                        <td class="px-8 py-5 text-sm">{{ $case->case_type }}</td>
                        <td class="px-8 py-5 text-sm">{{ $case->status }}</td>
                        <td class="px-8 py-5 text-sm">{{ $case->priority }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<button class="fixed bottom-8 right-8 w-14 h-14 bg-primary-container text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-50">
    <span class="material-symbols-outlined">support_agent</span>
</button>

</body>
</html>