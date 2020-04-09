<template>
    <section class="text-bloc transition" v-bind:style='{backgroundColor: bloc.color}'>
        <div class="container">
            <p class="text-content">
                {{bloc.text}}
            </p>
        </div>
    </section>
</template>

<script>
    import gsap from 'gsap'

    export default {        
        props: [
            'bloc'
        ],
        mounted() {
            var textPart = document.getElementsByClassName("text-bloc");
            var scrollM = this.$scrollmagic;

            Array.prototype.forEach.call(textPart,function(el, i) {
                var textContent = el.children[0].getElementsByClassName("text-content")[0];
                var tl = new TimelineMax({ paused: false});

                tl.fromTo(textContent, 1.5, {y: 80, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false});
                
                const textScene = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: -300
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: 'TextSection' })
                scrollM.addScene(textScene)
            });
        }
    }
</script>

<style lang="scss" scoped>
    .text-bloc{
        font-size: 28px;
        padding-bottom: 108px;
        &.transition{
            padding-bottom: 250px;
            @media only screen and ( max-width : 680px ) {
                padding-bottom: 60px;
            }
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
