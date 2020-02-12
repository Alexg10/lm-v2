<template>

    <section class="text-bloc transition">
        <div class="container">
            <p class="text-content">
                {{bloc.text}}
            </p>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'bloc'
        ]
    }
</script>

<style lang="scss" scoped>
    .text-bloc{
        font-size: 28px;
        padding-bottom: 108px;
        &.transition{
            padding-bottom: 250px;
        }
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
        }
        @media only screen and ( max-width : 768px ) {
        }
        @media only screen and ( max-width : 680px ) {
            font-size: 18px;
            padding-bottom: 180px;
            max-width: 80%;
            margin: 0 auto;
        }
    }
</style>
