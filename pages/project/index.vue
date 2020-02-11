<template>
    <div>
        Project list

        <div v-if="projects" v-swiper:mySwiper="swiperOption">
            <div class="swiper-wrapper">
                <div v-for="project in projects" class="swiper-slide" :key="project.id">
                    <nuxt-link :to="`/project/${project.slug}`">{{project.title}}</nuxt-link>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-bullets"></div>
        </div>
    </div>
</template>

<script>

    import projects from '~/queries/projects'

    export default {
        data(){
            return{
                swiperOption: {
                    loop: true,
                    speed:1100,
                    slidesPerView: 3,
                    mousewheel: true,
                    centeredSlides: true,
                    hashNavigation: {
                        watchState: true,
                    },
                    // virtualTranslate: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    keyboard: {
                        enabled: true,
                    }
                }
            }
        },
        apollo: {
            projects : {
                prefetch : true,
                query : projects,
                update: (data) => data.projects.nodes
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>