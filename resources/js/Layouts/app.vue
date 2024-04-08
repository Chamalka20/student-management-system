<template>
    <div>
        <NavBar />
        <slot name="content" />
        <slot name="models" />
    </div>
</template>

<script >
    import NavBar from '@/Components/main/NavBar.vue'
    export default {
        components:{
            NavBar
        }
    }
</script>

<style lang="scss" scoped>

</style>