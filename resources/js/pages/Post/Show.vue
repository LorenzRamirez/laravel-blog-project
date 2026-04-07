<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  post: {
    type: Object,
    default: null,
  },
});
</script>

<template>
    <Head :title="post.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/posts"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button></Link>
                        <div class="mt-6 space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ post.title }}</h3>
                                <p class="mt-1 text-sm text-gray-600">Created on {{ new Date(post.created_at).toLocaleDateString() }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 bg-gray-50 p-4 text-gray-800">
                                {{ post.body }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
