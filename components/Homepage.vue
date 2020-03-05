<template>
        <div class="homepage-container">
            <div class="swiper-slide love-container">
                <div class="home-slide-content red">
                    <div class="bg-love">
                        <img class="bg-love-cover cover-1 visible" src="/images/home/lm_22.png" alt="">
                        <img class="bg-love-cover cover-2" src="/images/home/lm_1.jpg" alt="">
                        <img class="bg-love-cover cover-3" src="/images/home/lm_33.png" alt="">
                        <img class="bg-love-cover cover-4" src="/images/home/lm_44.png" alt="">
                        <img class="bg-love-cover cover-5" src="/images/home/lm_55.png" alt="">
                    </div>
                    <LoveContent/>
                    <div class="word-container link-hover" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
                        <div class="word elle">
                            <span class="hide">
                                <div class="hide-right">el</div>
                            </span>
                            <span class="hide">l</span>
                            <span class="hide">
                                <div class="hide-left">e</div>
                            </span>
                        </div>
                        <div class="word aime">
                            <span class="hide">
                                <div class="hide-right">ai</div>
                            </span>
                            <span class="hide">m</span>
                            <span class="hide">
                                <div class="hide-left">e</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide work-container">
                <div class="home-slide-content orange">
                    <nuxt-link to="project">
                        <div class="word-container" v-on:mouseenter="workHover" v-on:mouseleave="particuleAnimLeave"  v-on:click="workClick">
                            <span class="word work">work</span>
                            <span class="word work">work</span>
                            <span class="word work">work</span>
                        </div>
                    </nuxt-link>
                </div>
            </div>
        </div>
</template>

<script>
    import gsap from "gsap"
    import LoveContent from '~/components/project/LoveContent.vue'

    export default {
        components:{
            LoveContent
        },
        data(){
            return{
                coverIndex: 1, 
                playing:'',
                LoveClickTl : gsap.timeline({paused: true}),
                workClickTl : gsap.timeline({paused: true}),
            }
        },

        methods: {
            scrollSlide(){
                const work = document.querySelector('.work-container');
                var vm = this;
                var scrollable = true;
                window.addEventListener('wheel', function(e) {
                    if (e.deltaY < 0 && scrollable) {
                        scrollable = false;
                        console.log('up');
                        if( !work.classList.contains('visible') ){
                            work.classList.add("visible");
                        }else{
                            work.classList.remove("visible");
                        }
                        setTimeout(() => {
                            scrollable = true;
                        }, 1500);
                    }
                    if (e.deltaY > 0 && scrollable) {
                        console.log('down');
                        scrollable = false;

                        if( work.classList.contains('visible') ){
                            work.classList.remove("visible");
                        }else{
                            work.classList.add("visible");
                        }
                        setTimeout(() => {
                            scrollable = true;
                        }, 1500);
                    }
                });
            },
            loveHover(){
                document.querySelector('.bg-love').classList.add("visible");
                this.playing = setInterval(() => {
                    this.gif();
                }, 250)
            },
            loveLeave(){
                document.querySelector('.bg-love').classList.remove("visible");
                clearInterval(this.playing);
            },
            workHover(){
                this.particuleAnim()
            },
            workClick(){
                var vm=this;
                this.workClickTl.play();
                this.particuleAnimLeave();
                this.workClickTl.eventCallback("onComplete", function () {
                    vm.$router.push({
                        path: '/project/'
                    })
                });
            }, 
            loveClick(){
                document.querySelector('.word-container').classList.add("clicked");
                document.querySelector('.love-content').classList.add("visible");
                //TODO ADD 3SEC
                document.querySelector('.cross').classList.add("active");
            },
            gif(){
                const foo = document.querySelector('.bg-love');
                var gifLenght = foo.children.length;
                this.coverIndex++;
                var activeBg = document.querySelector('.cover-'+this.coverIndex);
                document.getElementsByClassName('bg-love-cover visible')[0].classList.remove("visible");
                activeBg.classList.add("visible");
                if(this.coverIndex >= foo.children.length){
                    this.coverIndex=0;
                }
            },
            particuleAnim(){
                function random(min, max) {
                    return Math.floor(Math.random() * (1 + max - min) + min);
                }
                var tlexplosion = gsap.timeline({});
                var num = 0;

                this.inter = window.setInterval(function () {
                    var typeParticule = random(1,12);
                    var div = document.createElement("div");
                    div.setAttribute("class", "sparkle part-" + num);
                    var particules = document.getElementById("cursor")[0];
                    document.querySelector("#cursor").appendChild(div);
                    var lastPart = document.querySelector(".part-" + num);
                    lastPart.classList.add("sparkle-"+typeParticule);
                    createDot(lastPart)
                    num++
                },100); 

                function createDot(elem){
                    gsap.fromTo(elem, {
                        left: "+=" + random(-20,20) + "px",
                        top: "+=" + random(-20,20) + "px",
                        z: 0,
                        opacity: 1
                    }, {
                        duration: 1.25,
                        left: "+=" + random(-200,200) + "px",
                        top: "+=" + random(-200,200) + "px",
                        z: "+=" + random(-725,600),
                        opacity: 0,
                        ease: "power4.inOut"
                    });
                }
            },
            particuleAnimLeave(){
                clearInterval(this.inter);
                setTimeout(function(){
                    document.querySelectorAll('.sparkle').forEach(
                        e => e.remove()
                    );
                }, 1500)
            }
        },
        mounted() {
            // this.LoveClickTl.to(".elle", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire")
            //                 .to(".aime", {x: "80vw", duration: 1, ease: "power4.in"}, "fire");

            this.workClickTl.to(".work:nth-child(1)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire")
                            .to(".work:nth-child(2)", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire+=0.1")
                            .to(".work:nth-child(3)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire+=0.2");
            
            this.scrollSlide();

        }
    }
</script>

<style lang="scss" scoped>

    body{
        overflow: hidden;
    }

    .homepage-container{
        position: relative;
        overflow: hidden;
        .work-container{
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            &.visible{
                display: block;
            }
        }
    }
    a{
        text-decoration: none;
        color: black;
        transition: all 0.6s ease;
    }
    .swiper-container{
        height: 100vh;
    }
    .swiper-slide{
        width: 100vw;
        // height: 100%!important;
    }
    .bg-love{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: green;
        opacity: 0;
        pointer-events: none;
        transition: all 0.9s cubic-bezier(.19,.77,.2,1);
        &.visible{
            opacity: 1;
            transition: all 0.9s cubic-bezier(.19,.77,.2,1);
        }
        img{
            width: 100%;
            height: 100vh;
            object-fit: cover;
            display: none;
            &.visible{
                display: block;
            }
        }
    }
    .home-slide-content{
        position: relative;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 200px;
        text-align: center;
        font-weight: bold;
        background: white;
        @media ( max-width : 680px ) {
            font-size: 130px;
        }
        // &.red{
        //     background-color: red;
        // }
        // &.orange{
        //     background-color: orange;
        // }
        .word-container{
            display: block;
            &:hover{
                cursor: pointer;
                .word,
                a{
                    color: #FF9170;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }
                .hide{
                    color: #FF9170;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                    .hide-right,
                    .hide-left{
                        color: #FF9170;
                        transform: translateX(0);
                        opacity: 1;
                        transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                    }
                }
                //ELLE AIME
                .elle{
                    color: #FF9170;
                    left: -79px;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }
                .aime{
                    color: #FF9170;
                    left: 125px;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }

                //WORK
                .work{
                    transition: all 1.05s cubic-bezier(.19,.77,.2,1);
                    &:nth-child(1){
                        position: relative;
                        left: 107px;
                    }
                    &:nth-child(2){
                        position: relative;
                        left: -22px;
                    }
                    &:nth-child(3){
                        position: relative;
                        left: 182px;
                    }
                }
            }
            &.clicked{
                .elle{
                    left: -79px;
                    transform: translateX(-80vh);
                    transition: all 2s cubic-bezier(.19,.77,.2,1);

                }
                .aime{
                    transform: translateX(80vh);
                    left: 125px;
                    transition: all 2s cubic-bezier(.19,.77,.2,1);

                }
                .hide{
                    .hide-right,
                    .hide-left{
                        transform: translateX(0);
                    }
                }
            }
            .word{
                display: flex;
                line-height: 160px;
                color: black;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            }
            .hide{
                width: auto;
                overflow: hidden;
                display: inline-block;
                color: black;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                .hide-right{
                    color: black;
                    transform: translateX(100%);
                    opacity: 0.3;
                    transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                }
                .hide-left{
                    color: black;
                    transform: translateX(-100%);
                    opacity: 0.3;
                    transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                }
            }
            //ELLE AIME
            .elle{
                position: relative;
                bottom: -38px;
                left: -37px;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                @media ( max-width : 680px ) {
                    bottom: -48px;
                    left: -27px;
                }
            }
            .aime{
                position: relative;
                top: -39px;
                left: 9px;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                @media ( max-width : 680px ) {
                    top: -58px;
                    left: 3px;
                }
            }
            //WORK
            .work{
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                &:nth-child(1){
                    position: relative;
                    bottom: -77px;
                    left: 27px;
                    @media ( max-width : 680px ) {
                        bottom: -106px;
                        left: 0px;
                    }
                }
                &:nth-child(2){
                    position: relative;
                    left: 155px;
                    @media ( max-width : 680px ) {
                        left: 71px;
                    }
                }
                &:nth-child(3){
                    position: relative;
                    top: -73px;
                    left: -79px;
                    @media ( max-width : 680px ) {
                        top: -99px;
                        left: -82px;
                    }
                }
            }
        }
    }
    @keyframes heart-beat {
        0%{
            transform: scale(1);
        }
        50%{
            transform: scale(1.5);
        }
        100%{
            transform: scale(1);
        }
    }






    .cross{
		position: absolute;
        top: 15px;
        left: 50%;
		width: 40px;
		height: 40px;
		// border: 1px solid black;
		// border-radius: 100px;
        transform: translateX(-50%);
		&:hover{
			cursor: pointer;
		}
		&.active{
			.crossLineOne{
				.crossLineOne_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
					transition-delay:0.3s;
				}
			}
			.crossLineTwo{
				.crossLineTwo_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
				}
			}
		}
	}
	.crossLineOne{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(-45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(100%, 0%);
			transition: 0.4s ease;
			transition-delay:0.3s;
		}
	}
	.crossLineTwo{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(-100%, 0%);
			transition: 0.4s ease;
		}
	}
</style>