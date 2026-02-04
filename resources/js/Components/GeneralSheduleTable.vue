<template>
    <div
        class="bg-white border border-gray-100 rounded-lg overflow-hidden shadow-sm"
    >
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th
                            v-for="day in days"
                            :key="day.date"
                            class="py-8 px-4 text-center min-w-[190px]"
                        >
                            <div
                                class="text-[10px] font-semibold uppercase text-gray-400 mb-1"
                            >
                                {{ day.weekdayName }}
                            </div>
                            <div class="text-lg font-semibold text-black">
                                {{ day.displayDate }}
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td
                            v-for="day in days"
                            :key="day.date"
                            class="align-top p-4 border-r border-gray-50 last:border-r-0 min-h-[500px]"
                        >
                            <div class="space-y-4">
                                <template v-if="day.sections.length > 0">
                                    <Link
                                        v-for="section in day.sections"
                                        :key="section.id"
                                        :href="`/sections/${section.id}`"
                                        class="block p-4 rounded-2xl bg-white border border-gray-100 hover:border-black transition-all duration-300 group"
                                    >
                                        <h4
                                            class="text-sm font-semibold text-gray-900 group-hover:text-black"
                                        >
                                            {{ section.name }}
                                        </h4>
                                    </Link>
                                </template>

                                <div
                                    v-else
                                    class="flex flex-col items-center justify-center py-20 opacity-10"
                                >
                                    <div
                                        class="w-12 h-px bg-gray-400 mb-2"
                                    ></div>
                                    <div class="w-6 h-px bg-gray-400"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: { Link },
    props: {
        days: Array,
    },
    methods: {
        formatTime(dateStr) {
            return new Date(dateStr).toLocaleTimeString("ru-RU");
        },
    },
};
</script>

<style scoped>
td {
    vertical-align: top;
}
</style>
