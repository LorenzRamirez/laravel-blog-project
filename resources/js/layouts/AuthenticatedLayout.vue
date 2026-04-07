<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const isActive = (path: string) => {
    return page.url === path || page.url.startsWith(`${path}/`);
};
</script>

<template>
    <AppLayout>
        <div class="space-y-6">
            <slot name="header" />
            <slot />
        </div>
    </AppLayout>
</template>
