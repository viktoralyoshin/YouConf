<template>
    <div class="min-h-screen flex flex-col bg-white">
        <header
            class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50"
        >
            <div
                class="container mx-auto px-6 h-16 flex justify-between items-center"
            >
                <Link
                    href="/"
                    class="flex items-center space-x-3 hover:opacity-80 transition-opacity"
                >
                    <div class="bg-black p-1.5 rounded-lg">
                        <img src="@img/logo.png" alt="Logo" class="h-6 w-6" />
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900"
                        >Удивительный Мир</span
                    >
                </Link>
            </div>
        </header>
        <main class="flex-grow flex items-center justify-center py-12 px-4">
            <div
                class="w-full max-w-[350px] animate-in fade-in slide-in-from-bottom-4 duration-700"
            >
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: "AuthLayout",
};
</script>
