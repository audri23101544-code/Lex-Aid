<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Anonymous Legal Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Legal Forum</h1>

    <nav class="flex gap-6">
        @if(isset($user))
            @if($user->role === 'client')
                <a href="/client" class="hover:text-[#FCD353]">Client Dashboard</a>
            @elseif($user->role === 'lawyer')
                <a href="/lawyer" class="hover:text-[#FCD353]">Lawyer Dashboard</a>
            @elseif($user->role === 'admin')
                <a href="/admin" class="hover:text-[#FCD353]">Admin Dashboard</a>
            @endif
        @endif

        <a href="/forum" class="text-[#FCD353] font-bold">Forum</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-6xl mx-auto py-10 px-6">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#002147]">Anonymous Ask-a-Lawyer Forum</h2>
        <p class="text-slate-600 mt-2">
            Post legal questions anonymously and view public legal discussions.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <section class="bg-white rounded-xl shadow p-6 lg:col-span-1">
            <h3 class="text-xl font-bold text-[#002147] mb-4">Post a Question</h3>

            <form method="POST" action="/forum/post" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold mb-2">Question Title</label>
                    <input type="text" name="title" class="w-full border rounded p-3" placeholder="Example: Can my landlord evict me without notice?" required>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2">Category</label>
                    <select name="category" class="w-full border rounded p-3">
                        <option value="">Select category</option>
                        <option value="Family Law">Family Law</option>
                        <option value="Criminal Law">Criminal Law</option>
                        <option value="Civil Law">Civil Law</option>
                        <option value="Property Law">Property Law</option>
                        <option value="Employment Law">Employment Law</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2">Your Question</label>
                    <textarea name="question" rows="6" class="w-full border rounded p-3" placeholder="Write your legal question here..." required></textarea>
                </div>

                <button type="submit" class="w-full bg-[#002147] text-white py-3 rounded font-bold hover:bg-[#003366]">
                    Post Anonymously
                </button>
            </form>
        </section>

        <section class="bg-white rounded-xl shadow p-6 lg:col-span-2">
            <h3 class="text-xl font-bold text-[#002147] mb-4">Forum Questions</h3>

            @if($questions->count() === 0)
                <p class="text-slate-600">No questions posted yet.</p>
            @else
                <div class="space-y-5">
                    @foreach($questions as $q)
                        <div class="border rounded-xl p-5 hover:bg-slate-50">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h4 class="text-lg font-bold text-[#002147]">{{ $q->title }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Posted by Anonymous
                                        @if($q->category)
                                            · {{ $q->category }}
                                        @endif
                                        · {{ $q->created_at }}
                                    </p>
                                </div>

                                <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-bold">
                                    Anonymous
                                </span>
                            </div>

                            <p class="text-slate-700 mt-4 leading-relaxed">
                                {{ $q->question }}
                            </p>

                            <div class="mt-5 border-t pt-4">
                                <h5 class="font-bold text-[#002147] mb-3">Replies</h5>

                                @if(isset($replies[$q->id]) && $replies[$q->id]->count() > 0)
                                    <div class="space-y-3 mb-4">
                                        @foreach($replies[$q->id] as $reply)
                                            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                                <p class="text-sm text-slate-700">{{ $reply->reply }}</p>
                                                <p class="text-xs text-slate-500 mt-2">
                                                    Answered by Advocate {{ $reply->lawyer_name ?? 'Lawyer' }}
                                                    · {{ $reply->created_at }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-slate-500 mb-4">No replies yet.</p>
                                @endif

                                @if(isset($user) && ($user->role === 'lawyer' || $user->role === 'admin'))
                                    <form method="POST" action="/forum/reply/{{ $q->id }}" class="mt-4">
                                        @csrf
                                        <textarea name="reply" rows="3" class="w-full border rounded p-3" placeholder="Write your legal reply..." required></textarea>
                                        <button type="submit" class="mt-2 bg-[#002147] text-white px-4 py-2 rounded font-bold hover:bg-[#003366]">
                                            Post Reply
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
</main>

</body>
</html>