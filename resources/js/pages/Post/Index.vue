<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

interface Post {
  id: number;
  title: string;
  body: string;
}

interface PostsData {
  data: Post[];
  total: number;
  current_page: number;
  last_page: number;
  from: number;
  to: number;
  prev_page_url: string | null;
  next_page_url: string | null;
}

const props = defineProps<{
  posts: PostsData;
}>();

const form = useForm({});

const deletePost = (id: number): void => {
  form.delete(`/posts/${id}`);
};
</script>

<template>
  <Head title="Manage Posts" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h1 class="text-2xl font-semibold text-slate-900">Manage Posts</h1>
          <p class="mt-1 text-sm text-slate-500">Create, edit, and delete your blog posts from a single place.</p>
        </div>
        <Link
          href="/posts/create"
          class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-500/20 transition hover:bg-sky-700"
        >
          Create New Post
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-xl shadow-slate-200/40">
          <!-- Header -->
          <div class="border-b border-slate-200 px-6 py-6 sm:px-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              <div>
                <p class="text-sm uppercase tracking-[0.24em] text-sky-600">Posts overview</p>
                <h2 class="mt-2 text-xl font-semibold text-slate-900">All published entries</h2>
              </div>
              <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600">
                Total posts: <span class="font-semibold text-slate-900">{{ props.posts.total }}</span>
              </div>
            </div>
          </div>

          <!-- Table -->
          <div class="p-6 sm:p-8">
            <div class="overflow-hidden rounded-3xl border border-slate-200 shadow-sm">
              <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-500">
                  <tr>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.24em]">ID</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.24em]">Title</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.24em]">Content</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.24em]">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                  <tr v-for="post in props.posts.data" :key="post.id" class="hover:bg-slate-50">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">{{ post.id }}</td>
                    <td class="px-6 py-4 text-slate-900">{{ post.title }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ post.body }}</td>
                    <td class="px-6 py-4">
                      <div class="flex flex-wrap gap-2">
                        <Link
                          :href="`/posts/${post.id}/edit`"
                          class="inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                          Edit
                        </Link>
                        <button
                          @click="deletePost(post.id)"
                          class="inline-flex items-center rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-600"
                        >
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="!props.posts.data || props.posts.data.length === 0">
                    <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500">No posts yet.</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-slate-200 px-6 py-4 sm:px-8">
              <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-slate-600">
                  Showing <span class="font-semibold">{{ props.posts.from || 0 }}</span>
                  to
                  <span class="font-semibold">{{ props.posts.to || 0 }}</span>
                  of
                  <span class="font-semibold">{{ props.posts.total }}</span>
                  results
                </div>
                <div class="flex gap-2">
                  <Link
                    v-if="props.posts.prev_page_url"
                    :href="props.posts.prev_page_url"
                    class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                  >
                    Previous
                  </Link>
                  <button
                    v-else
                    disabled
                    class="inline-flex items-center rounded-lg border border-slate-300 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-400 cursor-not-allowed"
                  >
                    Previous
                  </button>
                  <span class="flex items-center px-2 py-2 text-sm text-slate-700">
                    Page {{ props.posts.current_page || 1 }} of {{ props.posts.last_page || 1 }}
                  </span>
                  <Link
                    v-if="props.posts.next_page_url"
                    :href="props.posts.next_page_url"
                    class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                  >
                    Next
                  </Link>
                  <button
                    v-else
                    disabled
                    class="inline-flex items-center rounded-lg border border-slate-300 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-400 cursor-not-allowed"
                  >
                    Next
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
