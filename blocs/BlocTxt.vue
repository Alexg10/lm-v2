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
        data(){
            return{
                timelines: {},
                scenes: []
            }
        },       
        props: [
            'bloc'
        ],
        methods: {
            createTimelines(){
                // blocTxt timeline
                const blocTxtTimeline = new TimelineMax({ paused: false});
                const textContent = this.$el.children[0].getElementsByClassName("text-content")[0];
                
                blocTxtTimeline.fromTo(textContent, 1.5, {y: 50, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false});

                this.timelines = {
                    txt: blocTxtTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.65,
                        offset: -300
                    })
                    .reverse(false)
                    .setTween(this.timelines.txt)
                ]
            }
        },
        mounted() {
            // Create timelines and scenes
            this.createTimelines();
            this.createScenes();

            // Add scenes to controller
            this.$scrollmagic.addScene(this.scenes);
        },
        destroyed() {
            this.$scrollmagic.removeScene(this.scenes);
        },
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
            margin: 0 auto;
            .container{
                max-width: 80%;
            }
        }
    }
</style>
