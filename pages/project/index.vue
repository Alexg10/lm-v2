<template>
    <div v-if="projects"  class="project-list">
        <div v-swiper:mySwiper="swiperOption" ref="mySwiper">
            <div class="swiper-wrapper">
                <div v-for="project in projects" class="swiper-slide" :key="project.id">
                    <nuxt-link :to="`/project/${project.slug}`" class="slide-link">
                        <div class="project-infos">
                            <div class="project-name-container">
                                <div class="project-name">{{project.acfProjectFields.projectTitle}}</div>
                            </div>
                            <div class="project-type-container">
                                <div class="project-type">{{project.acfProjectFields.projectType}}</div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <div class="slide-background" :style="{ backgroundImage: `url(${project.acfProjectFields.headerPicture.sourceUrl})` }">
                                <div class="slide-layer"></div>
                            </div>
                        </div>
                    </nuxt-link>
                </div>
            </div>
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
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
                    centeredSlides: true,
                    mousewheel: true,
                    spaceBetween: "49%",
                    hashNavigation: {
                        watchState: true,
                    },
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
        },
        methods: {
            slideNext(){
                this.$refs.mySwiper.swiper.slidePrev(1000);
            },
            slidePrev(){
                this.$refs.mySwiper.swiper.slidePrev(1000);
            }
        },
        mounted(){
            var vm = this;
            console.log(this.$refs.mySwiper.swiper);
            document.querySelector('.swiper-slide-next').addEventListener('click',function (e){
                e.preventDefault();
                console.log("mdjnfjsfjk");
                vm.$refs.mySwiper.swiper.slidePrev(1000);
                vm.slideNext();
                return false;
            });
        }
    }
</script>

<style lang="scss" scoped>
    .project-list{
        height: 100vh;
        display: block;
    }
    .swiper-container{
        height: 100%;
        .swiper-slide{
            position: relative;
            height: auto;
            align-self: center;
            overflow: visible;
            display: block;
            height: 100%;
        }
    }

    .project-name-container,
    .project-type-container{
        overflow: hidden;
    }

    .project-name{
        display: inline-block;
        text-decoration: none;      
        white-space: nowrap;  
        font-size: 200px;
        text-decoration: none;     
        transform: translateY(210px);
        color: #FF9170;
        opacity: 0.3;
        transition: all 0.5s ease;
        z-index: 99;
    }
    .project-type{
        color: white;
        font-size: 16px;
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 1px;
        transform: translateY(50px);
        transition: 0.5s ease-in-out;
        pointer-events: none;
        text-align: center;
    }
    //SWIPE ACTIVE
    .swiper-slide-active,
    .swiper-slide-duplicate-active{
        .project-name{
            transform: translateY(0);
            opacity: 0.3;
            transition: color 0.5s ease, opacity 0.5s ease, transform 5s ease;
            transition-delay: 1s;
            transition-property: transform;
        }
        &:hover{
            .project-name{
                opacity: 1;
                transition: all 0.5s ease;
            }
            .slide-layer{
                opacity: 0.4;
                transition: opacity 0.5s ease;
            }
            .project-type{
                transform: translateY(0);
                transition: transform 0.4s ease;
            }
        }
    }
    //SWIPE NEXT
    .swiper-slide-next,
    .swiper-slide-duplicate-next{
        transform: translateX(0px);
        transition: all 0.5s ease;
        pointer-events: none;
        &:hover{
            transform: translateX(-30px);
            transition: all 0.6s ease;
        }
    }
    //SWIPE PREV
    .swiper-slide-prev,
    .swiper-slide-duplicate-prev{
        transform: translateX(0);
        transition: all 0.5s ease;
        pointer-events: none;
        &:hover{
            transform: translateX(30px);
            transition: all 0.6s ease;
        }
    }
    .swiper-button-prev,
    .swiper-button-next{
        top: 0;
        width: 22%;
        height: 100%;
        margin-top: 0;
        right: 0!important;
        opacity: 0;
        z-index: 10;
    }
    .swiper-button-prev{
        right: auto!important;
        left: 0!important;
    }

    .project-infos{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99;
    }
    .slide-container{
        text-decoration: none;
        height: 100vh;
        max-height: 70vh;
        width: 560px;
        display: block;
        overflow: hidden;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .slide-background{
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        max-height: 70vh;
        width: 560px;
        background-size: cover;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        z-index: 99;
        transform: translate(-50%, -50%) scale(1.1);
        .slide-layer{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #FF9170;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
    }

</style>