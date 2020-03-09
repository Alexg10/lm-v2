<template>
    <section v-if="bloc" class="img-full-center-section">
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="bloc.blocImgFullCenterImg.sourceUrl" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    import gsap from "gsap"
    
    export default {
        props: [
            'bloc'
        ],
        mounted(){

            var scrollM = this.$scrollmagic;
            var blocsImgFullCenter = document.getElementsByClassName("img-full-center-section");

            Array.prototype.forEach.call(blocsImgFullCenter,function(el, i) {
                var tl = new TimelineMax({ paused: false});

                var img = el.children[0].getElementsByClassName("img-full-center-section-container");
                tl.fromTo(img, 2.5, {y: 100, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                
                
                const animSectionScene = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: -250
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: 'blocsImgFullCenter' })
                scrollM.addScene(animSectionScene)

            });
        }
    }
</script>

<style lang="scss" scoped>
    .img-full-center-section{
        position: relative;
        .img-full-center-section-container{
            position: relative;
            display: flex;
            justify-content: center;
            z-index: 9;
            img{
                width: 100%;
            }
        }
    }
</style>