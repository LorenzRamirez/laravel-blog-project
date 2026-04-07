<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  post: {
    type: Object,
    default: null,
  },
});

const form = useForm({
  title: props.post.title,
  body: props.post.body,
});

const submit = () => {
  form.put(`/posts/${props.post.id}`);
};
</script>

<template>
    <Head title="Edit Post" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Edit Post</h1>
                    <p class="mt-1 text-sm text-slate-500">Update the title or content for this post.</p>
                </div>
                <Link
                    href="/posts"
                    class="inline-flex items-center justify-center rounded-full bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                >
                    Back to posts
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-xl shadow-slate-200/40">
                    <div class="border-b border-slate-200 px-6 py-6 sm:px-8">
                        <p class="text-sm uppercase tracking-[0.24em] text-sky-600">Edit entry</p>
                        <h2 class="mt-2 text-xl font-semibold text-slate-900">Update post details</h2>
                    </div>
                    <div class="p-6 sm:p-8">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-slate-700">Title</label>
                                <input
                                    id="title"
                                    type="text"
                                    v-model="form.title"
                                    required
                                    class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100"
                                />
                            </div>

                            <div>
                                <label for="body" class="block text-sm font-semibold text-slate-700">Body</label>
                                <textarea
                                    id="body"
                                    v-model="form.body"
                                    required
                                    rows="6"
                                    class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-full bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-500/20 transition hover:bg-sky-700"
                            >
                                Update post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
