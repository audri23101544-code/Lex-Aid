<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>LexAid | Digital Magistrate Admin</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
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
                    borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
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
<!-- SideNavBar -->
<aside class="bg-[#002147] dark:bg-slate-950 h-screen w-64 fixed left-0 top-0 overflow-y-auto flex flex-col border-r border-white/5 shadow-2xl z-50">
<div class="p-6">
<div class="text-2xl font-serif italic text-white mb-1">LexAid</div>
<div class="text-xs font-label text-[#FCD353] uppercase tracking-widest opacity-80">Digital Magistrate</div>
</div>
<nav class="flex-1 mt-4 space-y-1">
<!-- Active Tab: Dashboard -->
<a class="flex items-center space-x-3 px-4 py-3 text-[#FCD353] bg-white/10 rounded-lg mx-2 scale-95 transition-transform" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label">Dashboard</span>
</a>
<a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
<span class="material-symbols-outlined" data-icon="folder_open">folder_open</span>
<span class="font-label">Case Files</span>
</a>
<a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
<span class="material-symbols-outlined" data-icon="description">description</span>
<span class="font-label">Documents</span>
</a>
<a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
<span class="material-symbols-outlined" data-icon="calendar_today">calendar_today</span>
<span class="font-label">Calendar</span>
</a>
<a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
<span class="material-symbols-outlined" data-icon="chat_bubble">chat_bubble</span>
<span class="font-label">Messages</span>
</a>
<a class="flex items-center space-x-3 px-4 py-3 text-slate-300 hover:text-white transition-all duration-300 hover:bg-white/5" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label">Settings</span>
</a>
</nav>
<div class="p-4">
<a href="/submit-case" class="w-full bg-secondary-container text-on-secondary-container py-3 rounded-xl font-semibold flex items-center justify-center space-x-2 shadow-lg active:scale-95 transition-transform">
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
<span>New Case</span>
</a>
</div>
<div class="mt-auto p-4 border-t border-white/5 space-y-1">
<a class="flex items-center space-x-3 px-4 py-2 text-slate-400 hover:text-white transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-label text-sm">Support</span>
</a>
<a class="flex items-center space-x-3 px-4 py-2 text-slate-400 hover:text-white transition-colors" href="/logout">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-label text-sm">Logout</span>
</a>
</div>
</aside>
<!-- TopAppBar -->
<header class="fixed top-0 right-0 w-[calc(100%-16rem)] h-16 z-40 bg-white/85 backdrop-blur-md flex items-center justify-between px-8 border-b border-slate-100">
<div class="flex items-center space-x-8">
<div class="relative group">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
<span class="material-symbols-outlined text-sm" data-icon="search">search</span>
</span>
<input class="bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all" placeholder="Search cases, lawyers, or documents..." type="text"/>
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
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="p-2 hover:bg-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="account_balance">account_balance</span>
</button>
<button class="p-2 hover:bg-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="dark_mode">dark_mode</span>
</button>
</div>
<div class="h-8 w-8 rounded-full overflow-hidden border border-slate-200">
<img alt="User Profile" data-alt="Close-up portrait of a professional senior administrator in a suit, soft studio lighting, corporate photography style" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsUsa3-hjlPfmzExudcGCotPmBuVwqeAqnM3kQrTxdUkK6QtS_gP9_TWtCirD5drvthgKofHrQFO_o1weZI2HBmHqfgpJKr1zUwRxjn_Lr2Q_xBYeFRPaYeXSbqyftMbAN_luFSzgu30i8NDn0E868QEh0hr_2MkFdkY1VnzgjUP5V-PuK9qFySa-983JCBXd4I9eG2VgBLyHW3uGlDNtgIiMAHs3NjAyaZ6iXEPHsDiXKzw4mbFXDBguoGqvny0m09jhDUlDAgFJw"/>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="ml-64 pt-24 p-8 min-h-screen">
<!-- Dashboard Header -->
<div class="mb-10 flex justify-between items-end">
<div>
<h1 class="text-4xl font-headline text-primary mb-2">System Oversight</h1>
<p class="text-on-surface-variant font-body">Administrative overview of LexAid ecosystem performance and resource allocation.</p>
</div>
<div class="flex items-center space-x-2 text-sm font-label text-on-surface-variant">
<span class="material-symbols-outlined text-xs" data-icon="schedule">schedule</span>
<span>Last system sync: 4 minutes ago</span>
</div>
</div>
<!-- Metric Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
<!-- Active Cases -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-primary-container bg-primary-fixed p-2 rounded-lg" data-icon="gavel">gavel</span>
<span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">+12%</span>
</div>
<div class="text-3xl font-headline text-primary">{{ $allCases->count() }}</div>
<div class="text-sm font-label text-on-surface-variant">Total Active Cases</div>
</div>
<div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
<div class="w-3/4 h-full bg-primary-container"></div>
</div>
</div>
<!-- Funding Allocation -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-secondary bg-secondary-fixed p-2 rounded-lg" data-icon="payments">payments</span>
<span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded">On Track</span>
</div>
<div class="text-3xl font-headline text-primary">$4.2M</div>
<div class="text-sm font-label text-on-surface-variant">Grant Funding Disbursed</div>
</div>
<div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
<div class="w-1/2 h-full bg-secondary"></div>
</div>
</div>
<!-- Lawyer Workload -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-tertiary bg-tertiary-fixed p-2 rounded-lg" data-icon="group">group</span>
<span class="text-xs font-bold text-on-error-container bg-error-container px-2 py-1 rounded">High Load</span>
</div>
<div class="text-3xl font-headline text-primary">82%</div>
<div class="text-sm font-label text-on-surface-variant">Avg. Resource Capacity</div>
</div>
<div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
<div class="w-4/5 h-full bg-error"></div>
</div>
</div>
<!-- System Uptime/Audit -->
<div class="bg-primary-container p-6 rounded-xl shadow-2xl flex flex-col justify-between text-white">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-[#FCD353]" data-icon="verified_user">verified_user</span>
<span class="text-[10px] tracking-widest uppercase font-bold opacity-60">System Security</span>
</div>
<div class="text-3xl font-headline text-[#FCD353]">99.9%</div>
<div class="text-sm font-label opacity-80">Audit Compliance Score</div>
</div>
<div class="mt-4 flex -space-x-2">
<div class="w-6 h-6 rounded-full border-2 border-primary-container overflow-hidden">
<img alt="Tech" data-alt="Portrait of a young tech professional, smiling, clean bright background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpd9P2CbqdFyqMRK3_fr4c1MmsbagLpM1I5aC24p-0YKyQy8FPcy6Sv1Zfv8HifXYHRgbzpM9hq725qnsEdCkvbwBNAroHmYdC5l-srD-adoQolhbJjCBZnkDzvO50npMbCvf8w4_sK5RBY-ppOoO-fbHko0ZMuJPgZ-h2R6mWW2V9MCi0RgP4XU3LqKdxuJlfIaK5xq-OwnexkaaSwk157CUOY3b4ia-A356neOg8W9FuUdmVgBV953yveObZBmNI4PUvCGbHgyDp"/>
</div>
<div class="w-6 h-6 rounded-full border-2 border-primary-container overflow-hidden">
<img alt="Tech" data-alt="Professional man with glasses looking at camera, minimalist background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBeSkafQvq3lbyU-qKD0TLjBBJK-BhVoTkljyc9FHsGcWNtJrlm0rqwE-N4AGz3hoOsSqOL2COllvmogY2qmha08bEIZj7hoog-KLfWiJ9blHsOtcBHGCtJ6I37hG-e_jgGJ36O5V0q9zfC7nXSdY7KpvMD6GxWcme0vROn_z9yf51RAcq7yozBq9-dKfkqfl3U3tjFaWwob0u9tqgCg9dycoOzRJzUcLow1KOfu4nCi8AKr6hPuMcrlMFABRtmAFA6bRi2puu0wcNj"/>
</div>
<div class="w-6 h-6 rounded-full border-2 border-primary-container bg-white/20 flex items-center justify-center text-[10px]">+4</div>
</div>
</div>
</div>
<!-- Case Assignment Workflow Section -->
<div class="mt-12 bg-white rounded-xl shadow-sm border border-outline-variant/5 overflow-hidden">
<div class="p-8 border-b border-slate-50 flex justify-between items-center bg-surface-container-lowest">
<div>
<h3 class="text-2xl font-headline text-primary">Pending Case Assignments</h3>
<p class="text-sm text-on-surface-variant font-body">Manage the distribution of incoming legal requests to the magistrate network.</p>
</div>
<div class="flex items-center space-x-3">
<div class="flex -space-x-3">
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-xs font-bold">12</div>
<div class="text-xs font-label text-slate-500 flex items-center pl-6">Waiting Lawyers</div>
</div>
</div>
</div>
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low text-[10px] uppercase tracking-widest text-on-surface-variant font-bold">
<th class="px-8 py-4">Ref ID</th>
<th class="px-8 py-4">Petitioner</th>
<th class="px-8 py-4">Legal Domain</th>
<th class="px-8 py-4">Urgency</th>
<th class="px-8 py-4">Recommended Lead</th>
<th class="px-8 py-4 text-right">Action</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-50">
@foreach($allCases as $case)
<tr class="hover:bg-slate-50/50 transition-colors">
<td class="px-8 py-5 font-label text-sm font-bold text-primary-container">#LX-{{ $case->id }}</td>
<td class="px-8 py-5">
<div class="text-sm font-medium">{{ optional(DB::table('users')->find($case->client_id))->name ?? 'Unknown' }}</div>
<div class="text-[10px] text-slate-400">Filed {{ \Carbon\Carbon::parse($case->created_at)->diffForHumans() }}</div>
</td>
<td class="px-8 py-5">
<span class="bg-surface-container px-3 py-1 rounded-full text-[10px] font-bold">{{ $case->case_type }}</span>
</td>
<td class="px-8 py-5">
<div class="flex items-center space-x-2">
<span class="w-2 h-2 rounded-full bg-error"></span>
<span class="text-xs font-medium">{{ $case->priority }}</span>
</div>
</td>
<td class="px-8 py-5">
<div class="flex items-center space-x-2">
@if($case->lawyer_id)
<div class="w-6 h-6 rounded-full overflow-hidden bg-slate-200">
<img alt="Lawyer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2Lhw2BcOD7O3DMC14ZLf_hyneNuoy1Lwi2TipFfe6sHH5E2gAxE13GFWjw0Iwxdy5wWJi9b4pCYnwqb-ai9cEe9NJ_PJ7AIdbMlxZRTLFgCa2wpxwkvtD1ccEL-yO-bN_2lYjPpzLojrVEa2EM_sKvfzA7dEaJUlwzNJ-2rvfQoOuSkBcvgmXOBl0YtMAObP_DgEu-qdYghtf42SOT-i5DIb2DBqMJc77drg24vKd5BN9ISt_baa8JwHRdfqmdMpYc0otHhJwW8Pg"/>
</div>
<span class="text-xs">{{ optional(DB::table('users')->find($case->lawyer_id))->name ?? 'Unknown' }}</span>
@else
<span class="text-[10px] italic text-slate-400">No Suggestion</span>
@endif
</div>
</td>
<td class="px-8 py-5 text-right">
<a href="/case/{{ $case->id }}" class="text-secondary font-bold text-xs hover:underline">View case detail</a>
</td>
</tr>
@endforeach
</tbody>
</table>
<div class="p-4 bg-surface-container-low text-center">
<button class="text-xs font-label uppercase tracking-widest font-bold text-on-surface-variant hover:text-primary transition-colors">Load more pending cases</button>
</div>
</div>
</main>
<!-- Contextual FAB (Only shown on relevant dashboard screens) -->
<button class="fixed bottom-8 right-8 w-14 h-14 bg-primary-container text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-50">
<span class="material-symbols-outlined" data-icon="support_agent">support_agent</span>
</button>
</body></html>

