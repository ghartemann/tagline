<template>
    <div class="tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
        <div class="tw-w-[72rem] tw-flex tw-flex-col tw-gap-10 tw-items-center tw-justify-center">
            <img src="@images/logo.svg" alt="logo">

            <div class="tw-text-white">Devinez titre du film dont le slogan (Tagline) est issu.</div>

            <TaglineContainer></TaglineContainer>
        </div>

        <div class="tw-absolute tw-bottom-0 tw-right-[-18rem] tw-h-[70vh] tw-w-[40rem] tw-bg-[#1F009C] tw-rounded-t-full"></div>
    </div>
</template>

<script setup>
import TaglineContainer from './components/TaglineContainer.vue'
</script>

<style scoped>

</style>
