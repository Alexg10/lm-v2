<template>
    <div class="footer-project" v-bind:style='{backgroundColor: color}'>
        <div class="footer-project-content">
            <div class="link-to-link" v-scroll-to="{
                el: '.footer-project-content',
                offset: 50,
                duration: 2000,
                easing: [0.24, 0.88, 0.41, 1],
                cancelable: false            
                }" data-cursor-hover>
                <div class="link-to linkHover">
                    <div class="next-project up-letters">next project</div> 
                    <div class="next-project-name up-letters">{{link.acfProjectFields.projectTitle}}</div>
                    <img class="arrow" :src="arrowDown" alt="">
                </div>
                <div class="next-cover" :style="{ backgroundImage: `url(${link.acfProjectFields.headerPicture.sourceUrl})` }"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'
    import gsap from 'gsap'

    export default {
        data(){
            return{
                arrowDown,
                timelines: {},
                scenes: []
            }
        },
        props: [
            'link',
            'color'
        ],
        methods: {
            changeProject() {
                console.log("changeProject");
                // Set project to store
                this.$store.commit('setCover', this.link);
                // Animate out
                this.$router.push({
                    path: `/project/${this.link.slug}`
                })
            },
            letterContainer(className){
                var word = document.getElementsByClassName(className)[0];
                var wordContent = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML = "";

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.style.minWidth = "5px";
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }
            },
            createTimelines(){
                // Footer timeline
                const footerTimeline = new TimelineMax({paused: false})
                .fromTo(".next-cover", 1, {opacity: 0, width: "70%"}, {opacity: 1, width: "100%"}, "start")
                .eventCallback("onComplete", this.scrollToBottom);

                // Letter timeline
                const upLetterTimeline = new TimelineMax({ paused: false});
                for(let word of document.getElementsByClassName("up-letters")){
                    const letters = word.childNodes;
                    for(let i=0; i<letters.length; i++ ){
                        var yValue= Math.floor(Math.random() * 90) + 1;
                        upLetterTimeline.fromTo(letters[i], 2, {y: 0},{y: -yValue, opacity: 0, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }
                }

                this.timelines = {
                    footer: footerTimeline,
                    letter: upLetterTimeline
                }
            },
            createScenes(){
                // Footer scene
                this.scenes = [
                    // Footer scene
                    this.$scrollmagic.scene({
                        triggerElement: '.footer-project-content',
                        triggerHook: 0.6,
                        offset: -300,
                        duration: 800
                    })
                    .setTween(this.timelines.footer),
                    // Letter scene
                    this.$scrollmagic.scene({
                        triggerElement: ".footer-project",
                        triggerHook: 0.7,
                        duration: 900
                    })
                    .setTween(this.timelines.letter)
                ];
            },
            scrollToBottom(){
                const vm = this;
                const VueScrollTo = require('vue-scrollto');
                VueScrollTo.scrollTo('.next-cover', 1400, {
                    duration: 1400,
                    easing: [0.24, 0.88, 0.41, 1],
                    force: true,
                    cancelable: false,
                    onDone: this.changeProject
                });
            }
        },
        mounted() {

            // Add span arround the word
            this.letterContainer("next-project");
            this.letterContainer("next-project-name");

            // Create timelines and scenes
            this.createTimelines();
            this.createScenes();

            // Add scenes to controller
            this.$scrollmagic.addScene(this.scenes);
        },
        destroyed() {
            this.$scrollmagic.removeScene(this.scenes);
        }
    }
</script>

<style lang="scss" scoped>
    .footer-project{
        position: relative;
        text-align: center;
        z-index: 9;
        padding-top: 100px;
        a{
            color: black;
            text-decoration: none;
            font-family: 'GTWalsheimProMedium';
            font-size: 16px;

        }
        .next-project-name{
            margin-bottom: 20px;
            font-family: 'GTWalsheimProMedium';
            span{

                font-family: 'GTWalsheimProMedium';
            }
        }
        .next-project{
            span{
                min-width: 7px!important;
                display: inline-block;
                font-family: 'GTWalsheimProMedium';
            }
            font-family: 'GTWalsheimProMedium';
        }
        .arrow{
            margin-bottom: 100px;
        }
    }
    span{
        display: inline-block;
    }
    .next-cover{
        height: 100vh;
        width: 80%;
        margin: 0 auto;
        background-size: cover;
        background-position: 50%;
        z-index: 9999;
    }
</style>