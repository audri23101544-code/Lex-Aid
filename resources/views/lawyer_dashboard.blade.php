<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>LexAid | The Digital Magistrate Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#F8F9FA",
                        "surface-dim": "#E9ECEF",
                        "on-surface": "#1A1C1E",
                        "on-surface-variant": "#44474E",
                        "primary": "#002147",
                        "on-primary": "#FFFFFF",
                        "primary-container": "#D6E3FF",
                        "on-primary-container": "#001B3D",
                        "secondary": "#745B00",
                        "on-secondary": "#FFFFFF",
                        "secondary-container": "#FCD353",
                        "on-secondary-container": "#241A00",
                        "tertiary": "#004B73",
                        "surface-container-lowest": "#FFFFFF",
                        "surface-container-low": "#F1F3F4",
                        "surface-container": "#EAEEF2",
                        "surface-container-high": "#E2E7ED",
                        "surface-container-highest": "#DEE3EB",
                        "outline": "#74777F",
                        "outline-variant": "#C4C6CF",
                        "error": "#BA1A1A",
                        "error-container": "#FFDAD6",
                        "on-error-container": "#410002"
                    },
                    fontFamily: {
                        "headline": ["Newsreader", "serif"],
                        "body": ["Manrope", "sans-serif"],
                        "label": ["Manrope", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-shadow {
            box-shadow: 0 12px 32px rgba(0, 33, 71, 0.08);
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">
<!-- Shell Layout -->
<div class="flex h-screen overflow-hidden">
<!-- SideNavBar Component -->
<aside class="bg-[#002147] flex flex-col h-full py-6 docked left-0 h-screen w-64 z-40 transition-all">
<div class="px-6 mb-10">
<div class="flex items-center gap-3">
<div class="w-10 h-10 bg-[#FCD353] rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-[#002147]" style="font-variation-settings: 'FILL' 1;">gavel</span>
</div>
<div>
<h1 class="text-xl font-bold tracking-tight text-[#FCD353] font-body">LexAid Magistrate</h1>
<p class="text-[0.65rem] uppercase tracking-widest text-slate-300 font-label">Superior Legal Counsel</p>
</div>
</div>
</div>
<nav class="flex-1 space-y-1">
<a class="bg-white/10 text-[#FCD353] border-r-4 border-[#FCD353] rounded-r-lg px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="text-[1.125rem] font-medium">Dashboard</span>
</a>
<a class="text-slate-300 hover:text-white hover:bg-white/5 px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined">folder_managed</span>
<span class="text-[1.125rem] font-medium">Case Files</span>
</a>
<a class="text-slate-300 hover:text-white hover:bg-white/5 px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined">event</span>
<span class="text-[1.125rem] font-medium">Calendar</span>
</a>
<a class="text-slate-300 hover:text-white hover:bg-white/5 px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined">edit_note</span>
<span class="text-[1.125rem] font-medium">Drafts</span>
</a>
<a class="text-[#ffdad6] hover:bg-error-container/20 px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">emergency_home</span>
<span class="text-[1.125rem] font-bold">SOS Alerts</span>
</a>
</nav>
<div class="px-6 mt-auto space-y-4">
<a href="/submit-case" class="w-full bg-[#FCD353] py-3 px-4 rounded-md text-[#002147] font-bold text-sm flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined">add_circle</span>
                New Case Entry
            </a>
<div class="pt-6 border-t border-white/10 space-y-2">
<a class="text-slate-300 hover:text-white flex items-center gap-3 text-sm font-label" href="#">
<span class="material-symbols-outlined text-sm">help_outline</span>
                    Help Center
                </a>
<a class="text-slate-300 hover:text-white flex items-center gap-3 text-sm font-label" href="/logout">
<span class="material-symbols-outlined text-sm">logout</span>
                    Logout
                </a>
</div>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden bg-surface">
<!-- TopAppBar Component -->
<header class="bg-white/80 backdrop-blur-md flex justify-between items-center w-full px-8 py-4 z-30 border-b border-outline-variant/30">
<div class="flex items-center gap-12">
<span class="text-2xl font-serif italic text-primary">LexAid</span>
<nav class="hidden md:flex gap-8">
<a class="text-primary border-b-2 border-secondary pb-1 font-medium transition-colors duration-300" href="#">Cases</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-300" href="#">Hearings</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-300" href="#">Documents</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-300" href="#">Clients</a>
</nav>
</div>
<div class="flex items-center gap-6">
<div class="relative hidden lg:block">
<input class="bg-surface-container border-none text-on-surface text-sm rounded-full py-2 pl-10 pr-4 w-64 focus:ring-1 focus:ring-primary" placeholder="Search precedents..." type="text"/>
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
</div>
<div class="flex items-center gap-4">
<button class="text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="h-8 w-8 rounded-full overflow-hidden border border-outline-variant">
<img alt="Lawyer Profile Avatar" class="w-full h-full object-cover" data-alt="professional lawyer headshot in a dark tailored suit against a neutral studio background soft rim lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvvcrxdm767WyY2JXRSoIKB8hCFCjQpFA6OXEug4sQhBryM9zvLvq5KAGyL8L3Irp73cJwI61tKvgegi2S46QJFXCOkF_a0UA2lD-q4IGbQ0ShQdtNFB4yhB6dPt57oLKSqxrTCFTqEYzc5dQbO7tlEJi_2y9HRgVbybtVTia_JFuyAx4J1sHj0hLNExKNwKgP_Ttzi9tQdFKGgFBwjQEjYtYApSvw1VEGtTj1JkryUVI8h0v_z0Taq6KdV0YAr9KGyiH41wBiyuvh"/>
</div>
</div>
</div>
</header>
<!-- Scrollable Canvas -->
<div class="flex-1 overflow-y-auto p-8 space-y-8">
<!-- Hero Section -->
<section class="flex flex-col md:flex-row justify-between items-end gap-6 border-b border-outline-variant/30 pb-8">
<div>
<span class="text-secondary font-label font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Magistrate Overview</span>
<h2 class="text-4xl md:text-5xl font-headline text-primary leading-tight italic">Welcomed back, <br/>Senior Counsel.</h2>
</div>
<div class="flex items-center gap-4 bg-white p-4 rounded-xl border border-outline-variant/30 shadow-sm">
<div class="text-right">
<p class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Local Standard Time</p>
<p class="text-xl font-body font-bold text-secondary">09:42 AM</p>
</div>
<div class="h-10 w-[1px] bg-outline-variant/30"></div>
<div class="text-right">
<p class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Court Status</p>
<p class="text-xl font-body font-bold text-primary">In Session</p>
</div>
</div>
</section>
<!-- Metrics Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm border-l-4 border-primary">
<p class="text-label-md text-on-surface-variant mb-1 uppercase tracking-tighter font-bold text-xs">Total Active Cases</p>
<div class="flex items-baseline gap-2">
<span class="text-3xl font-headline font-bold text-primary">{{ $allCases->count() }}</span>
<span class="text-xs text-secondary font-bold">+3 this week</span>
</div>
</div>
<div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm border-l-4 border-secondary">
<p class="text-label-md text-on-surface-variant mb-1 uppercase tracking-tighter font-bold text-xs">Your Cases</p>
<div class="flex items-baseline gap-2">
<span class="text-3xl font-headline font-bold text-primary">{{ $yourCases->count() }}</span>
<span class="text-xs text-on-surface-variant">Assigned</span>
</div>
</div>
<div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm border-l-4 border-tertiary">
<p class="text-label-md text-on-surface-variant mb-1 uppercase tracking-tighter font-bold text-xs">Evidence Reviews</p>
<div class="flex items-baseline gap-2">
<span class="text-3xl font-headline font-bold text-primary">12</span>
<span class="text-xs text-error font-bold">Priority</span>
</div>
</div>
<div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm border-l-4 border-outline">
<p class="text-label-md text-on-surface-variant mb-1 uppercase tracking-tighter font-bold text-xs">Workload Capacity</p>
<div class="flex items-baseline gap-2">
<span class="text-3xl font-headline font-bold text-primary">82%</span>
<div class="w-full bg-surface-container h-1.5 rounded-full overflow-hidden mt-2">
<div class="bg-secondary h-full" style="width: 82%"></div>
</div>
</div>
</div>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-12 gap-8">
<!-- Case Queue -->
<div class="col-span-12 lg:col-span-8 space-y-6">
<div class="flex justify-between items-center">
<h3 class="text-2xl font-headline italic text-primary">Your Cases</h3>
<button class="text-sm font-label text-primary font-bold hover:underline">View All Dossiers</button>
</div>
<div class="bg-white rounded-xl overflow-hidden border border-outline-variant/30 shadow-sm">
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-low text-on-surface-variant text-xs uppercase tracking-widest font-label">
<tr>
<th class="px-6 py-4">Ref ID</th>
<th class="px-6 py-4">Client / Case Title</th>
<th class="px-6 py-4 text-center">Priority</th>
<th class="px-6 py-4">Status</th>
<th class="px-6 py-4 text-right">Deadline</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
@foreach($yourCases as $case)
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-6 py-5 font-mono text-xs text-on-surface-variant">LX-{{ $case->id }}</td>
<td class="px-6 py-5">
<div class="font-bold text-primary group-hover:text-secondary transition-colors">{{ $case->title }}</div>
<div class="text-xs text-on-surface-variant">{{ optional(DB::table('users')->find($case->client_id))->name ?? 'Unknown' }}</div>
</td>
<td class="px-6 py-5 text-center">
@if($case->priority == 'High')
<span class="bg-error/10 text-error px-2 py-1 rounded text-[0.65rem] font-bold uppercase border border-error/20">Urgent</span>
@elseif($case->priority == 'Medium')
<span class="bg-secondary/10 text-secondary px-2 py-1 rounded text-[0.65rem] font-bold uppercase border border-secondary/20">Standard</span>
@else
<span class="bg-outline/10 text-on-surface-variant px-2 py-1 rounded text-[0.65rem] font-bold uppercase border border-outline/20">Low</span>
@endif
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
@if($case->status == 'pending')
<div class="w-2 h-2 rounded-full bg-secondary"></div>
<span class="text-sm font-medium text-on-surface">Pending</span>
@elseif($case->status == 'active')
<div class="w-2 h-2 rounded-full bg-primary"></div>
<span class="text-sm font-medium text-on-surface">Active</span>
@else
<div class="w-2 h-2 rounded-full bg-on-surface-variant"></div>
<span class="text-sm font-medium text-on-surface">{{ ucfirst($case->status) }}</span>
@endif
</div>
</td>
<td class="px-6 py-5 text-right font-label text-sm font-bold text-on-surface">{{ \Carbon\Carbon::parse($case->deadline)->format('M d') }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<!-- AI Enhanced Card -->
<div class="relative overflow-hidden rounded-xl bg-primary p-8 text-white shadow-lg">
<div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
<div class="flex-1">
<span class="bg-[#FCD353] text-[#002147] px-3 py-1 rounded-full text-[0.65rem] font-black uppercase tracking-widest mb-4 inline-block">AI Enhanced</span>
<h4 class="text-3xl font-headline italic mb-4">Precision in Practice</h4>
<p class="text-slate-300 font-body leading-relaxed mb-6">Our updated AI Document Generator now reaches 99.8% semantic accuracy across regional civil codes. Draft complex litigation briefs in seconds with magistrate-level oversight.</p>
<button class="bg-white text-primary px-6 py-2 rounded-md font-bold text-sm hover:bg-[#FCD353] hover:text-primary transition-colors">Access Generator</button>
</div>
<div class="w-full md:w-64 h-48 rounded-lg overflow-hidden relative shadow-2xl">
<img alt="Legal Authority" class="w-full h-full object-cover" data-alt="dramatic macro shot of an antique brass balance scale with soft cinematic light against a dark background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1XmaTgVogm4OSZTqD8Gi5oFLYQGMq5djRfvbJ6y1uX0sBpvivFxNLZpVptL2ahu6i6-GppeKeDP1oAx9WFGeXjbMvHG-iUxZR28DYIX26JaGMSYdV1bfc2uXZwVkNQoNggjlynnpv0U2p3y2crwfOJNkBgkSrydeuLyRu09k4E-9sqROBYG1oLu9ogqstnOqGrSa8zFcRF-GcGeOwVab4nE8TWN6OktQKj1aEdvu89OOruCkAOMeCv6qjh_-7txmGINHHOEsZIYL4PUvCGbHgyDp"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
</div>
</div>
<div class="absolute -right-20 -bottom-20 w-96 h-96 bg-secondary/10 rounded-full blur-3xl"></div>
</div>
</div>
<!-- Sidebar Panels -->
<div class="col-span-12 lg:col-span-4 space-y-8">
<!-- Hearing Alert Panel -->
<div class="bg-white rounded-xl p-6 shadow-md relative overflow-hidden group border border-outline-variant/30">
<div class="absolute top-0 right-0 p-3">
<span class="flex h-3 w-3">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
<span class="relative inline-flex rounded-full h-3 w-3 bg-secondary"></span>
</span>
</div>
<h3 class="text-xs font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-4">Next Hearing</h3>
<div class="space-y-4">
<div>
<h4 class="text-xl font-headline italic text-primary">Harbor Trust vs. Elias</h4>
<p class="text-sm text-secondary font-bold">Starts in 42 minutes</p>
</div>
<div class="bg-surface-container-low p-4 rounded-lg space-y-3 border border-outline-variant/20">
<div class="flex items-center gap-3 text-sm text-on-surface">
<span class="material-symbols-outlined text-on-surface-variant">location_on</span>
<span>District Court - Room 4B</span>
</div>
<div class="flex items-center gap-3 text-sm">
<span class="material-symbols-outlined text-on-surface-variant">link</span>
<a class="text-primary hover:underline font-bold" href="#">Secure Meeting Link</a>
</div>
</div>
<button class="w-full border-2 border-primary text-primary font-bold py-3 rounded-md hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">description</span>
                                Case Prep
                            </button>
</div>
</div>
<!-- Calendar Summary -->
<div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/20">
<h3 class="text-xs font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-6">Upcoming Agenda</h3>
<div class="space-y-6">
<div class="flex gap-4">
<div class="flex flex-col items-center">
<span class="text-xs font-label text-on-surface-variant font-bold">OCT</span>
<span class="text-xl font-headline font-bold text-primary">14</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">Discovery Deadline</p>
<p class="text-xs text-on-surface-variant">Apex Dynamics Dossier</p>
</div>
</div>
<div class="flex gap-4">
<div class="flex flex-col items-center">
<span class="text-xs font-label text-on-surface-variant font-bold">OCT</span>
<span class="text-xl font-headline font-bold text-primary">16</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">Client Briefing</p>
<p class="text-xs text-on-surface-variant">Sarah Jenkins Est.</p>
</div>
</div>
<div class="flex gap-4 opacity-50">
<div class="flex flex-col items-center">
<span class="text-xs font-label text-on-surface-variant font-bold">OCT</span>
<span class="text-xl font-headline font-bold text-primary">18</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">Quarterly Review</p>
<p class="text-xs text-on-surface-variant">Executive Chambers</p>
</div>
</div>
</div>
</div>
<!-- Quick SOS Trigger -->
<div class="bg-error-container/30 rounded-xl p-6 border border-error/20 group">
<div class="flex items-center gap-3 mb-4">
<span class="material-symbols-outlined text-error" style="font-variation-settings: 'FILL' 1;">emergency_home</span>
<h3 class="text-sm font-bold text-error uppercase tracking-widest">SOS Protocol</h3>
</div>
<p class="text-xs text-on-error-container mb-4">Immediately trigger legal intervention for emergency arrests or scene visits.</p>
<button class="w-full bg-error text-white font-black py-4 rounded-lg tracking-widest text-sm hover:bg-error/90 transition-all active:scale-95 uppercase shadow-sm">
                            Activate Emergency Response
                        </button>
</div>
</div>
</div>
</div>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-4 pt-2 bg-primary/95 backdrop-blur-xl border-t border-white/10">
<a class="flex flex-col items-center justify-center bg-secondary text-primary rounded-full p-2 h-12 w-12 transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">gavel</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-300 p-2 hover:text-white transition-all" href="#">
<span class="material-symbols-outlined">hourglass_empty</span>
<span class="text-[0.75rem] font-medium font-label">Status</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-300 p-2 hover:text-white transition-all" href="#">
<span class="material-symbols-outlined">calendar_add_on</span>
<span class="text-[0.75rem] font-medium font-label">Book</span>
</a>
<a class="flex flex-col items-center justify-center text-[#ffdad6] p-2 hover:text-white transition-all" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">sos</span>
<span class="text-[0.75rem] font-medium font-label">SOS</span>
</a>
</nav>
</main>
</div>
</body></html>