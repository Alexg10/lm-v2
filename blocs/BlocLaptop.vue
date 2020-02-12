<template>
    <div v-if="bloc">
        <section v-if="bloc.pictureVideo === 'picture'" class="project-laptop-preview container">
            <img :src="bloc.laptopPicture.sourceUrl" alt="">
        </section>
        <section v-if="bloc.pictureVideo === 'video'" class="project-laptop-preview container">
            //TODO: GERER VIDEO ICI NULL
            {{bloc.laptopVideo}}
            <video >
                <source src="/media/examples/flower.mp4" type="video/mp4">
            </video>
        </section>
    </div>
</template>

<script>
    export default {
        props: [
            'bloc'
        ]
    }
</script>

<style lang="scss" scoped>
    .project-laptop-preview{
        img{
            width: 100%;
        }
        @media ( max-width : 780px ) {
            padding: 0 20px;
            text-align: center;
            img{
                width: 100%;
            }
        }
        @media ( max-width : 680px ) {

        }
    }
</style>