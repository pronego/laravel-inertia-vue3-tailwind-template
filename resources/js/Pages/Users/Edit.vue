<script setup>
import Header from "@/Components/Header.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import SectionTitle from "@/Components/SectionTitle.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    user: Object
})

// useForm automatically sets property 'processing' (see submit button where it's used to disable it during processing)
const form = useForm({
    _method: 'PUT',
    user_id: props.user.id,
    username: props.user.username,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    firstname: props.user.firstname,
    lastname: props.user.lastname,
    cellphone: props.user.cellphone,
    date_of_birth: props.user.date_of_birth,
    holiday_entitlement: props.user.holiday_entitlement,
    active: Boolean(props.user.active)
});

const submit = () => {
    form.post(route('users.update', {user: form.user_id}), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <!-- Use Inertias head component to overwrite the default in Layouts/AppLayout.vue -->
    <Head :title="$t('Edit User')" />
    <Header>{{ $t('Edit User') }}</Header>


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <form @submit.prevent="submit">

            <!-- basic data -->
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <SectionTitle>
                    <template #title>
                        {{ $t('Login Data') }}
                    </template>
                    <template #description>
                        {{ $t('Basic Data for the Account.') }}
                    </template>
                </SectionTitle>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div
                        class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow"
                        :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                    >
                        <div class="grid grid-cols-6 gap-6">

                            <!-- username -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="name" :value="$t('Username')" />
                                <TextInput
                                    id="username"
                                    v-model="form.username"
                                    type="text"
                                    class="mt-1 block w-full"

                                    autocomplete="username"
                                />
                                <InputError :message="form.errors.username" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="email" :value="$t('Email')" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>


                            <!-- password -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="password" :value="$t('Password')" />
                                <TextInput
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="password"
                                />
                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="password_confirmation" :value="$t('Confirm Password')" />
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />
                                <InputError :message="form.errors.password_confirmation" class="mt-2" />
                            </div>

                            <!-- active -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="terms">
                                    <div class="flex items-center">
                                        <Checkbox id="active" v-model:checked="form.active" name="active" />

                                        <div class="ml-2">
                                            {{ $t('Account is Active') }}
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.active" />
                                </InputLabel>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /basic data -->


            <SectionBorder />


            <!-- personal data -->
            <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 sm:mt-0">

                <SectionTitle>
                    <template #title>
                        {{ $t('Personal Data') }}
                    </template>
                    <template #description>
                        tbd
                    </template>
                </SectionTitle>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div
                        class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow"
                        :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                    >
                        <div class="grid grid-cols-6 gap-6">

                            <!-- firstname -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="firstname" :value="$t('First Name')" />
                                <TextInput
                                    id="firstname"
                                    v-model="form.firstname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="firstname"
                                />
                                <InputError :message="form.errors.firstname" class="mt-2" />
                            </div>

                            <!-- lastname -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="lastname" :value="$t('Last Name')" />
                                <TextInput
                                    id="lastname"
                                    v-model="form.lastname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="lastname"
                                />
                                <InputError :message="form.errors.lastname" class="mt-2" />
                            </div>

                            <!-- cellphone -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="cellphone" :value="$t('Phone')" />
                                <TextInput
                                    id="cellphone"
                                    v-model="form.cellphone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="cellphone"
                                />
                                <InputError :message="form.errors.cellphone" class="mt-2" />
                            </div>

                            <!-- date_of_birth -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="date_of_birth" :value="$t('Date of Birth')" />
                                <TextInput
                                    id="date_of_birth"
                                    v-model="form.date_of_birth"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="date_of_birth"
                                />
                                <InputError :message="form.errors.date_of_birth" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /personal data -->


            <SectionBorder />


            <!-- other data -->
            <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 sm:mt-0">

                <SectionTitle>
                    <template #title>
                        {{ $t('Other') }}
                    </template>
                    <template #description>
                        tbd
                    </template>
                </SectionTitle>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div
                        class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow"
                        :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                    >
                        <div class="grid grid-cols-6 gap-6">

                            <!-- holiday_entitlement -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="name" :value="$t('Holiday Entitlement')" />
                                <TextInput
                                    id="holiday_entitlement"
                                    v-model="form.holiday_entitlement"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="holiday_entitlement"
                                />
                                <InputError :message="form.errors.holiday_entitlement" class="mt-2" />
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- /other data -->

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:col-start-2 md:col-span-2">
                    <PrimaryButton class="ml-4 md:ml-0" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ $t('Save') }}
                    </PrimaryButton>
                </div>
            </div>

        </form>

    </div>

</template>