<template>
    <div class="logo" >
        <div class="logo-container" v-on:mouseenter="logoHover" v-on:mouseleave="logoLeave" v-on:click="logoClick">
            <span class="letter first-letter">L</span>
            <span class="letter second-letter">M</span>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            logoHover(){
                document.querySelector('.cursor-fx__inner__outside').classList.add('hover'); 
            },
            logoLeave(){
                document.querySelector('.cursor-fx__inner__outside').classList.remove('hover'); 
            },
            logoClick(){
                var vm = this;
                document.querySelector('.logo').classList.remove('visible'); 
                document.querySelector('.project-title').classList.add('hidden'); 
                var slide;
                slide = document.querySelectorAll(".project-slide");
                for (var i = 0; i < slide.length; ++i) {
                    slide[i].classList.add('hidden');
                }
                this.$store.commit("setBack", true);
                setTimeout(function(){
                    vm.$router.push({
                        path: '/'
                    })
                }, 2500); 
            }
        }
    }
</script>

<style lang="scss" scoped>
    .logo{
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        text-align: center;
        font-size: 22px;
        z-index: 9;
        padding-top: 30px;
        @media ( max-width : 780px ) {
            padding-top: 40px;
        }
        @media ( max-width : 680px ) {
            padding-top: 40px;
        }
        &.visible{
            .logo-container{
                .first-letter,
                .second-letter{
                    transform: translateY(0%);
                    transition: 0.5s ease-in-out;
                }
                .second-letter{
                    transition-delay:0.35s;
                }
            }
        }
        .logo-container{
            display: inline-block;
            padding-top: 4px;
            overflow: hidden;
            padding-bottom: 20px;
            padding-right: 20px;
            .letter{
                float: left;
            }
            .first-letter{
                position: relative;
                top: -8px;
                left: 1px;
                transform: translateY(-120%);
                transition: 0.3s ease;
            }
            .second-letter{
                position: relative;
                top: 8px;
                left: -1px;
                transform: translateY(0%);
                transform: translateY(-120%);
                transition: 0.3s ease;
                transition-delay:0.4s;
            }
        }

    }
</style>