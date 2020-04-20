<template>
    <div class="footer-project" v-bind:style='{backgroundColor: color}'>
        <div class="footer-project-content">
            <div class="link-to-link" v-scroll-to="{
                el: '.next-cover',
                duration: 2000,
                easing: [0.24, 0.88, 0.41, 1],
                cancelable: false,
                onDone: changeProject
            }">
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
                arrowDown
            }
        },
        props: [
            'link',
            'color'
        ],
        methods: {
            changeProject() {
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
            }
        },
        mounted() {
            var vm = this;
            var footerTl= new TimelineMax({ paused: false});
            var scrollB = this.$scrollmagic;
            var scrollM = this.$scrollmagic;
            var VueScrollTo = require('vue-scrollto');
            const scrollOptions = {
                duration: 1400,
                easing: [0.24, 0.88, 0.41, 1],
                force: true,
                cancelable: false,
                onDone: function(element) {
                    VueScrollTo.unbind(element);
                    vm.changeProject();
                }
            }

            var upLetter = document.getElementsByClassName("up-letters");

            this.letterContainer("next-project");
            this.letterContainer("next-project-name");

            footerTl.fromTo(".next-cover",1, {opacity: 0, width: "75%"},{opacity: 1, width: "100%"},"start")
            .fromTo(".arrow",2, {opacity: 1},{opacity: 0},"start");
            const sceneFooter = scrollB.scene({
                triggerElement: '.footer-project-content',
                triggerHook: 0.8,
                offset: -200,
                duration: 900
            })
            .setTween(footerTl)
            // .addIndicators({ name: 'Footer' })
            scrollB.addScene(sceneFooter);

            footerTl.eventCallback("onComplete", function () {
                VueScrollTo.scrollTo('.next-cover', 1400, scrollOptions);
                footerTl.kill();
            });

            Array.prototype.forEach.call(upLetter,function(el, i) {
                var elements = el.childNodes;
                var upLetterTl = new TimelineMax({ paused: false});
                var element;
                for(var i=0; i<el.childNodes.length; i++ ){
                    var yValue= Math.floor(Math.random() * 90) + 1;
                    upLetterTl.fromTo(el.childNodes[i], 2, {y: 0},{y: -yValue, opacity: 0, ease: Power4.easeInOut, overwrite: false}, "start");                
                }
                const animLetterScene = scrollM.scene({
                    triggerElement: ".footer-project",
                    triggerHook: 0.7,
                    duration: 900
                })
                .setTween(upLetterTl)
                // .addIndicators({ name: 'upLetter' })
                scrollM.addScene(animLetterScene)
            });
        }
    }
</script>

<style lang="scss" scoped>
    .footer-project{
        position: relative;
        text-align: center;
        z-index: 9;
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