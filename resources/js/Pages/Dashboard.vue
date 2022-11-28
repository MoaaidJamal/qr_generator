<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    qr_path: String,
});

const form = useForm({
    content: '',
    size: 0,
    background_color: '',
    fill_color: '',
});

const submit = () => {
    form.post(route('generateQR'), {
        onFinish: () => form.reset('content', 'size', 'background_color', 'fill_color'),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Generate QR</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="content" value="Content" />

                            <TextInput
                                id="content"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.content"
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.content" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="size" value="Size" />

                            <TextInput
                                id="size"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.size"
                            />

                            <InputError class="mt-2" :message="form.errors.size" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="background_color" value="Background Color" />

                            <TextInput
                                id="background_color"
                                type="color"
                                class="mt-1 block w-full p-1"
                                v-model="form.background_color"
                            />

                            <InputError class="mt-2" :message="form.errors.background_color" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="fill_color" value="Fill Color" />

                            <TextInput
                                id="fill_color"
                                type="color"
                                class="mt-1 block w-full p-1"
                                v-model="form.fill_color"
                            />

                            <InputError class="mt-2" :message="form.errors.fill_color" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Generate QR
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="pb-12" v-if="qr_path">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-white text-xl mb-5">Last Generated QR</h1>
                    <img :src="qr_path" alt="QR" class="m-auto">
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
