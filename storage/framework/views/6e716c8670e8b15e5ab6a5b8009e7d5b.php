

<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>LexAid | Client Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#F8FAFC",
                        "on-surface": "#002147",
                        "on-surface-variant": "#475569",
                        "primary-container": "#002147",
                        "on-primary-container": "#FFFFFF",
                        "secondary": "#FCD353",
                        "on-secondary": "#3d2f00",
                        "outline-variant": "#E2E8F0",
                        "surface-container-low": "#FFFFFF",
                        "surface-container-high": "#FFFFFF",
                        "surface-container-lowest": "#FFFFFF",
                    },
                    fontFamily: {
                        "headline": ["Newsreader"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    },
                    borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
                },
            },
        }
    </script>
<style>
        body { font-family: 'Manrope', sans-serif; }
        h1, h2, h3, .serif { font-family: 'Newsreader', serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen selection:bg-secondary selection:text-on-secondary">
<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 flex justify-between items-center w-full px-8 py-4 bg-[#002147] bg-opacity-95 backdrop-blur-md shadow-md">
<div class="text-2xl font-serif italic text-[#FCD353]">LexAid</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-[#FCD353] border-b-2 border-[#FCD353] pb-1 font-medium" href="#">Overview</a>
<a class="text-slate-300 font-medium hover:text-[#FCD353] transition-colors duration-300" href="#">My Case</a>
<a class="text-slate-300 font-medium hover:text-[#FCD353] transition-colors duration-300" href="#">Evidence</a>
<a class="text-slate-300 font-medium hover:text-[#FCD353] transition-colors duration-300" href="#">Book Appointment</a>
<a class="text-slate-300 font-medium hover:text-[#FCD353] transition-colors duration-300" href="#">Legal Forum</a>
</nav>
<div class="flex items-center gap-4">
<button class="text-[#FCD353] hover:scale-95 duration-150 transition-transform">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-[#FCD353] hover:scale-95 duration-150 transition-transform">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="w-10 h-10 rounded-full border-2 border-[#FCD353] overflow-hidden">
<img alt="Lawyer Profile Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAM8E7NlwjKqw_tRBUVgxtTm1wbJwenzN7HD_bvwZ2uFAP45RoB-ynC-Ii64RFvZWECH-g2Q3R3arlbUDNwdfO_lDmMZXggx4n9g38OXRqpd8e3lzSBDo_NO79iCkEThpikbUkfrCePnyHhZQkLwilqQlFoK9qjupJWw3x-QzoEDmH-TTll17ppOh7fkCs_TI7CofDaqfWT__y5wfgbOjaY-9oclvGcqetZpoO_jWMAtXvv_Rw2Vs_roW8mIAhKtSby6DVxu5gYLhCm"/>
</div>
</div>
<div class="flex gap-4">
    <a href="/case/create" class="bg-[#FCD353] text-[#3d2f00] px-6 py-3 rounded font-bold">
        Submit New Case
    </a>

    <a href="/client/sos" class="bg-red-600 text-white px-6 py-3 rounded font-bold">
        🚨 Emergency SOS
    </a>
</div>
</header>
<main class="max-w-7xl mx-auto px-6 py-12 space-y-12 mb-24">
<!-- Welcome Banner -->
<section class="relative overflow-hidden rounded-xl bg-primary-container p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl">
<div class="z-10 text-center md:text-left">
<h1 class="text-5xl md:text-6xl text-white mb-4 italic">Justice is Near, <?php echo e(session('user_name')); ?>.</h1>
<p class="text-xl text-slate-300 font-body max-w-lg">Your case is progressing according to the Magistrate's schedule. Review your status and recent counsel below.</p>
</div>
<div class="relative z-10">
<a href="/submit-case" class="bg-[#FCD353] text-[#3d2f00] px-8 py-4 rounded-xl font-bold flex items-center gap-3 hover:shadow-2xl transition-all transform hover:-translate-y-1">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">emergency_home</span>
                Submit New Case
            </a>
</div>
<!-- Decorative background element -->
<div class="absolute right-0 top-0 w-1/2 h-full opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[300px] absolute -right-20 -top-20 text-white">gavel</span>
</div>
</section>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Left Column: Case Health & Financials -->
<div class="lg:col-span-8 space-y-8">
<!-- Case Progress Timeline -->
<?php if($yourCases->count() > 0): ?>
<?php $case = $yourCases->first(); ?>
<div class="bg-white rounded-xl p-8 shadow-sm border border-slate-100">
<h2 class="text-2xl text-on-surface mb-8 font-serif">Procedural Progress</h2>
<div class="flex flex-col md:flex-row items-start md:items-center justify-between relative gap-6">
<!-- Connecting Line -->
<div class="hidden md:block absolute top-10 left-0 w-full h-0.5 bg-slate-100"></div>
<!-- Step 1 -->
<div class="flex flex-col items-center text-center relative z-10 gap-3 group">
<div class="w-12 h-12 rounded-full bg-slate-100 text-green-600 flex items-center justify-center border border-slate-200">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
<div>
<div class="text-sm font-bold text-on-surface">Application</div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Submitted</div>
</div>
</div>
<!-- Step 2 -->
<div class="flex flex-col items-center text-center relative z-10 gap-3">
<div class="w-12 h-12 rounded-full bg-slate-100 text-green-600 flex items-center justify-center border border-slate-200">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<div>
<div class="text-sm font-bold text-on-surface">Means Test</div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Passed</div>
</div>
</div>
<!-- Step 3 -->
<div class="flex flex-col items-center text-center relative z-10 gap-3">
<?php if($case->lawyer_id): ?>
<div class="w-12 h-12 rounded-full overflow-hidden bg-slate-200">
<img alt="Assigned Lawyer" class="w-full h-full object-cover rounded-full border-2 border-[#FCD353]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfRnBGs3ywZ0ZCg_o3JCHz-Lz_o7elfLPXnoZx0tKGGWOW0uIzGxVCSgmOQZvsMLfqXX4lwrGaeV82ZS-jURDX-MM0KM-465_ICWaL-TcQR-tukFfQZyLIQSSIjfh6metouAJqSQtPdiK1-6JLmqqe8UHlJWI078iXLKeUUjI7NPm7eUxmu0J2FttSs6ZouXsD7qm4KQbgvPR2d1f3jDju-3s5rM8QVxGdVy2WXXGS0xHNn0nPWUMAIx4ywcagX6oMLrkOPkSysnq2"/>
</div>
<div>
<div class="text-sm font-bold text-on-surface">Lawyer Assigned</div>
<div class="text-[10px] text-[#b08d03] uppercase tracking-widest font-bold">Lead: <?php echo e(optional(DB::table('users')->find($case->lawyer_id))->name ?? 'Unknown'); ?></div>
</div>
<?php else: ?>
<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200">
<span class="material-symbols-outlined">person</span>
</div>
<div>
<div class="text-sm font-bold text-on-surface">Lawyer Assignment</div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Pending</div>
</div>
<?php endif; ?>
</div>
<!-- Step 4 Active -->
<div class="flex flex-col items-center text-center relative z-10 gap-3">
<div class="w-16 h-16 rounded-full bg-[#002147] flex items-center justify-center text-white ring-8 ring-blue-50">
<span class="material-symbols-outlined text-3xl">search_insights</span>
</div>
<div>
<div class="text-lg font-bold text-[#002147]"><?php echo e(ucfirst($case->status)); ?> Phase</div>
<div class="text-[10px] text-[#002147] uppercase tracking-widest font-extrabold">Active Phase</div>
</div>
</div>
<!-- Step 5 -->
<div class="flex flex-col items-center text-center relative z-10 gap-3 opacity-40">
<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200">
<span class="material-symbols-outlined">balance</span>
</div>
<div>
<div class="text-sm font-bold text-on-surface">Resolution</div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Pending</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- Financial Standing (Bento Card) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="bg-white rounded-xl p-8 border-l-8 border-[#FCD353] shadow-sm flex flex-col justify-between border-y border-r border-slate-100">
<div>
<div class="flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-[#FCD353]" style="font-variation-settings: 'FILL' 1;">shield_with_heart</span>
<span class="text-on-surface-variant text-sm font-bold uppercase tracking-widest">Financial Standing</span>
</div>
<h3 class="text-3xl font-serif text-[#002147]">Means Test: <span class="text-[#b08d03]">PASSED</span></h3>
<p class="text-on-surface-variant mt-4 leading-relaxed">Based on your reported income and assets, you qualify for **Tier 1 Legal Aid Support**, covering 100% of procedural costs.</p>
</div>
<div class="mt-8 space-y-4">
<div class="space-y-2">
<div class="flex justify-between text-sm">
<span class="text-on-surface-variant font-medium">Annual Income</span>
<span class="text-[#002147] font-bold">$24,400</span>
</div>
<div class="h-2 bg-slate-100 rounded-full overflow-hidden">
<div class="h-full bg-[#FCD353] w-[35%]"></div>
</div>
</div>
<div class="space-y-2">
<div class="flex justify-between text-sm">
<span class="text-on-surface-variant font-medium">Disposable Assets</span>
<span class="text-[#002147] font-bold">$3,120</span>
</div>
<div class="h-2 bg-slate-100 rounded-full overflow-hidden">
<div class="h-full bg-[#FCD353] w-[15%]"></div>
</div>
</div>
</div>
</div>
<!-- Communication Card -->
<?php if($yourCases->count() > 0): ?>
<div class="bg-white rounded-xl p-8 shadow-md border border-slate-100 flex flex-col">
<div class="flex items-center gap-4 mb-6">
<?php if($case->lawyer_id): ?>
<img alt="Lawyer Avatar" class="w-12 h-12 rounded-full object-cover border border-slate-200" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNhWHotR_CfxCm3YbmkeOa7YKJxcosJrMcosjTbZg5QMQR6zwNp5pS0S6cvBzN7kVvkMS_-ExKLcVxqrDxAR0S1t-fC-zC_7IUhmbTJOfSiXR4YBvKElwWEYs9y8eaoKuWSTtvZEBX3TC0l2kIL1sLuIf4fTa_iHLXUmmINVNWVUMtnfs44ZTtth9N32T88Yp4Z07xTaMAO8Kgmjt98myRrGWL5EyIGFraoARR5BdTdKwbnBw6YQVnQvpwOUts_VKPrcWu_YxTi_-"/>
<div>
<div class="text-sm font-bold text-[#002147]"><?php echo e(optional(DB::table('users')->find($case->lawyer_id))->name ?? 'Unknown'); ?>, Esq.</div>
<div class="text-[10px] text-[#b08d03] uppercase font-bold">Lead Counsel</div>
</div>
<?php else: ?>
<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200">
<span class="material-symbols-outlined">person</span>
</div>
<div>
<div class="text-sm font-bold text-[#002147]">Legal Team</div>
<div class="text-[10px] text-[#b08d03] uppercase font-bold">Assignment Pending</div>
</div>
<?php endif; ?>
</div>
<p class="text-on-surface-variant text-sm italic line-clamp-4 mb-6 leading-relaxed">
<?php if($case->lawyer_id): ?>
"<?php echo e($case->title); ?>, I've reviewed your case details. We need you to upload the original lease agreement to strengthen our position in the <?php echo e(ucfirst($case->status)); ?> Phase..."
<?php else: ?>
"Your case has been received and is being processed. A lawyer will be assigned shortly to begin working on your matter."
<?php endif; ?>
</p>
<div class="mt-auto">
<button class="w-full bg-[#002147] text-white py-3 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#003366] transition-all">
<span class="material-symbols-outlined text-lg">reply</span>
                            Reply Now
                        </button>
</div>
</div>
<?php endif; ?>
</div>
</div>
<!-- Right Column: Actions & Files -->
<div class="lg:col-span-4 space-y-8">
<!-- Document Upload Zone -->
<div class="bg-white rounded-xl p-8 border-2 border-dashed border-slate-200 hover:border-[#002147] transition-colors flex flex-col items-center text-center group cursor-pointer shadow-sm">
<div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-[#002147] text-3xl">upload_file</span>
</div>
<h3 class="text-xl font-serif text-[#002147] mb-2">Evidence Depository</h3>
<p class="text-on-surface-variant text-sm px-4">Drag and drop your case documents here or click to browse. Supported: PDF, JPG, PNG.</p>
<div class="mt-6 flex flex-wrap gap-2 justify-center">
<div class="px-3 py-1 bg-slate-100 rounded-full text-[10px] text-on-surface-variant font-bold">Affidavits</div>
<div class="px-3 py-1 bg-slate-100 rounded-full text-[10px] text-on-surface-variant font-bold">Lease</div>
<div class="px-3 py-1 bg-slate-100 rounded-full text-[10px] text-on-surface-variant font-bold">Photos</div>
</div>
</div>
<!-- Upcoming Appointment -->
<div class="bg-[#002147] rounded-xl p-6 text-white overflow-hidden relative shadow-lg">
<div class="flex items-start justify-between mb-4">
<span class="material-symbols-outlined text-[#FCD353]">event</span>
<span class="text-[10px] bg-[#FCD353] text-[#002147] px-2 py-0.5 rounded-full font-bold">NEXT WEEK</span>
</div>
<h4 class="text-lg font-bold mb-1">Pre-Trial Consultation</h4>
<p class="text-xs text-slate-300 mb-4">Zoom Video Call • Oct 24, 2023</p>
<button class="text-[#FCD353] text-sm font-bold flex items-center gap-2 hover:underline">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
<span class="material-symbols-outlined absolute -bottom-4 -right-4 text-8xl opacity-10">video_call</span>
</div>
<!-- Quick Help / Forum -->
<div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100">
<h4 class="text-sm font-bold text-on-surface-variant mb-4 uppercase tracking-widest">Client Resources</h4>
<ul class="space-y-4">
<li class="flex items-center gap-3 group cursor-pointer">
<div class="p-2 rounded bg-slate-50 text-[#002147] group-hover:bg-[#002147] group-hover:text-white transition-colors border border-slate-100">
<span class="material-symbols-outlined text-sm">forum</span>
</div>
<span class="text-sm text-on-surface font-semibold">Tenant Rights Forum</span>
</li>
<li class="flex items-center gap-3 group cursor-pointer">
<div class="p-2 rounded bg-slate-50 text-[#002147] group-hover:bg-[#002147] group-hover:text-white transition-colors border border-slate-100">
<span class="material-symbols-outlined text-sm">help_center</span>
</div>
<span class="text-sm text-on-surface font-semibold">Procedural FAQ</span>
</li>
</ul>
</div>
</div>
</div>
</main>
<!-- Bottom Navigation (Mobile) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-4 pt-2 bg-[#002147] backdrop-blur-xl border-t border-[#FCD353]/10 shadow-2xl">
<a class="flex flex-col items-center justify-center bg-[#FCD353] text-[#002147] rounded-full p-2 h-12 w-12 transition-all active:scale-90" href="/submit-case">
<span class="material-symbols-outlined">gavel</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 p-2 hover:text-[#FCD353] transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">hourglass_empty</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 p-2 hover:text-[#FCD353] transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">calendar_add_on</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 p-2 hover:text-[#FCD353] transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">sos</span>
</a>
</nav>
<?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/client_dashboard.blade.php ENDPATH**/ ?>