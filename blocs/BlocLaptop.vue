<template>
    <div v-if="bloc">
        <section v-if="bloc.pictureVideo === 'picture'" class="project-laptop-preview container">
            <img :src="bloc.laptopPicture.sourceUrl" alt="">
        </section>
        <section v-if="bloc.pictureVideo === 'video'" class="project-laptop-preview container">
            <video class="project-laptop-preview-video" loop>
                <source :src="bloc.laptopVideo" type="video/mp4">
            </video>
        </section>
    </div>
</template>

<script>

    import gsap from 'gsap'

    export default {
        data() {
            return {
            }
        },
        props: [
            'bloc'
        ],
        mounted() {
            var scrollM = this.$scrollmagic;
            var tl = new TimelineMax({ paused: false});
            var img = document.getElementsByClassName("project-laptop-preview");
            tl.fromTo(img, 2.5, {y: 100, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});        
            tl.eventCallback("onComplete", ()=> {
                console.log('play');
                document.querySelector('.project-laptop-preview-video').play();
            });

            const animSectionScene = scrollM.scene({
                triggerElement: ".project-laptop-preview",
                triggerHook: 0.65,
                offset: -250
            })
            .setTween(tl)
            .reverse(false)
            // .addIndicators({ name: 'blocsImgFullCenter' })
            scrollM.addScene(animSectionScene)
        },
    }
</script>

<style lang="scss" scoped>
    .project-laptop-preview{
        text-align: center;
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