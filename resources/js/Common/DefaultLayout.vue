<template>
    <div
        class="flex flex-col min-h-screen bg-[#F9F9FB] text-[#1a1a1a] font-sans"
    >
        <Toaster position="bottom-right" richColors closeButton />

        <header class="bg-white border-b border-gray-100 py-3">
            <div
                class="container mx-auto px-6 flex justify-between items-center"
            >
                <div class="flex items-center space-x-3">
                    <div class="bg-black p-1.5 rounded-lg">
                        <img src="@img/logo.png" alt="Logo" class="h-6 w-6" />
                    </div>
                    <span class="text-xl font-bold">Удивительный Мир</span>
                </div>

                <div class="flex items-center space-x-4">
                    <NotificationsDropdown v-if="$page.props?.user_data" />

                    <template v-if="$page.props?.user_data">
                        <Link
                            :href="'/user/' + $page.props.user_data.id"
                            class="flex items-center bg-white border border-gray-200 py-1.5 pl-1.5 pr-4 rounded-full hover:shadow-md transition-all"
                        >
                            <!-- <img
                                :src="$page.props?.user_data?.avatar"
                                alt="Avatar"
                                class="h-7 w-7 rounded-full object-cover mr-2"
                            /> -->
                            <span class="text-sm font-semibold">{{
                                $page.props?.user_data?.first_name
                            }}</span>
                        </Link>
                    </template>
                    <template v-else>
                        <a
                            href="/login"
                            class="bg-black text-white text-sm font-medium px-6 py-2.5 rounded-full hover:bg-gray-800 transition-all shadow-sm"
                        >
                            Войти
                        </a>
                    </template>
                </div>
            </div>
        </header>

        <nav
            class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-gray-100 z-[50]"
        >
            <div
                class="container mx-auto flex justify-center items-center space-x-1 p-2"
            >
                <template v-if="$page.props?.allPages">
                    <template
                        v-for="page in $page.props.allPages"
                        :key="page.slug"
                    >
                        <a
                            :href="`/${page.slug}`"
                            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-all"
                        >
                            {{ page.title }}
                        </a>
                    </template>
                </template>
                <a
                    href="/sections"
                    class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-all"
                    >Секции</a
                >
                <a
                    href="/schedules"
                    class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-all"
                >
                    Раписание
                </a>
                <a
                    v-if="$page.props?.role === 'expert'"
                    href="/theses"
                    class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-all"
                >
                    Тезисы
                </a>
            </div>
        </nav>

        <main class="flex-grow container mx-auto p-6">
            <div class="max-w-7xl mx-auto">
                <slot></slot>
            </div>
        </main>

        <footer class="bg-white border-t border-gray-100 py-10">
            <div
                class="container mx-auto px-6 text-center text-gray-400 text-sm font-medium"
            ></div>
        </footer>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import NotificationsDropdown from "@/Components/NotificationsDropdown.vue";
import { Toaster, toast } from "vue-sonner";
import "vue-sonner/style.css";

export default {
    name: "DefaultLayout",
    components: {
        Link,
        NotificationsDropdown,
        Toaster,
    },
    props: {
        sections: Array,
    },
    computed: {
        userProfileLink() {
            return `/user/${this.$page.props?.user_data?.id}`;
        },
    },
    methods: {
        handleFlashMessages(flash) {
            if (flash?.success) {
                toast.success(flash.success);
            }
            if (flash?.error) {
                toast.error(flash.error);
            }
        },
        switchUser(userId) {
            this.$inertia.visit(`/switch-user/${userId}`);
        },
    },
    watch: {
        "$page.props.flash": {
            handler(newFlash) {
                this.handleFlashMessages(newFlash);
            },
            deep: true,
        },
    },
    mounted() {
        this.handleFlashMessages(this.$page.props.flash);
    },
};
</script>
