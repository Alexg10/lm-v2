<template>
    <section v-if="bloc" class="img-patchwork">
        <div class="container">
            <div class="img-patchwork-one-container">
                <div class="img-pachwork-img" v-for="(patchworkOneImg, index) in bloc.firstPatchwork" v-bind:key>
                    <img :src="patchworkOneImg.firstPatchworkImages.sourceUrl" v-bind:class="'img-patwork-one-index'">
                </div>
            </div>
            <div class="patchwork-txt">
                {{bloc.patchworkTxt}}
            </div>
            <div class="img-patchwork-two-container">
                <div class="img-pachwork-img" v-for="(patchworkTwoImg, index) in bloc.secondPatchwork" v-bind:key>
                    <img :src="patchworkTwoImg.secondPatchworkImg.sourceUrl" v-bind:class="'img-patwork-two-index'">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'bloc'
        ],
        mounted(){

            var img1img = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(1) img");
            var img2img = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(2) img");
            var img3img = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(3) img");
            var img4img = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(4) img");
            var img1 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(1)");
            var img2 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(2)");
            var img3 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(3)");
            var img4 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(4)");

            var img5img = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(1) img");
            var img6img = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(2) img");
            var img7img = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(3) img");
            var img8img = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(4) img");
            var img9img = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(5) img");
            var img5 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(1)");
            var img6 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(2)");
            var img7 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(3)");
            var img8 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(4)");
            var img9 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(5)");

            var scrollM = this.$scrollmagic;

            var tlPatchwork = new TimelineMax({ paused: false});
            var tlPatchwork2 = new TimelineMax({ paused: false});
            var tlImages = new TimelineMax({ paused: false});
            var tlImages2 = new TimelineMax({ paused: false});

            var heightDurationFirst = document.querySelector(".img-patchwork-one-container").offsetHeight;
            var heightDurationSec = document.querySelector(".img-patchwork-two-container").offsetHeight;

            tlPatchwork.fromTo(img1, 1, {y: -30},{y: 0, overwrite: false},"start")
            .fromTo(img2, 1, {y: 5},{y: 60, overwrite: false}, "start")
            .fromTo(img3, 1, {y: 50},{y: 0, overwrite: false}, "start")
            .fromTo(img4, 1, {y: -110},{y: 0, overwrite: false}, "start");

            tlImages.fromTo(img1img, 1, {y: -20},{y:20, overwrite: false},"start")
            .fromTo(img2img, 1, {y: -20},{y:20, overwrite: false}, "start")
            .fromTo(img3img, 1, {y: -20},{y:20, overwrite: false}, "start")
            .fromTo(img4img, 1, {y: -20},{y:20, overwrite: false}, "start");

            
            const scenePatchwork = scrollM.scene({
                triggerElement: ".img-patchwork",
                triggerHook: 0.65,
                offset: -50,
                duration: heightDurationFirst+700
            })
            .setTween(tlPatchwork)
            // .addIndicators({ name: '22222 (duration: 300)' })
            scrollM.addScene(scenePatchwork);

            const scenePatchworkImg = scrollM.scene({
                triggerElement: ".img-patchwork",
                triggerHook: 0.65,
                offset: -50,
                duration: heightDurationFirst+700
            })
            .setTween(tlImages)
            // .addIndicators({ name: '22222 (duration: 300)' })
            scrollM.addScene(scenePatchworkImg);

            tlPatchwork2.fromTo(img5, 1, {y: -30},{y: 10, overwrite: false},"startTwo")
            .fromTo(img6, 1, {y: 5},{y: -10, overwrite: false}, "startTwo")
            .fromTo(img7, 1, {y: 50},{y: -50, overwrite: false}, "startTwo")
            .fromTo(img8, 1, {y: -50},{y: 0, overwrite: false}, "startTwo")
            .fromTo(img9, 1, {y: -50},{y: 0, overwrite: false}, "startTwo");

            tlImages2.fromTo(img5img, 1, {y: -20},{y: 20, overwrite: false},"startTwo")
            .fromTo(img6img, 1, {y: -20},{y: 20, overwrite: false}, "startTwo")
            .fromTo(img7img, 1, {y: -20},{y: 20, overwrite: false}, "startTwo")
            .fromTo(img8img, 1, {y: -20},{y: 20, overwrite: false}, "startTwo")
            .fromTo(img9img, 1, {y: -20},{y: 20, overwrite: false}, "startTwo");

            const scenePatchwork2 = scrollM.scene({
                triggerElement: ".patchwork-txt",
                triggerHook: 0.65,
                offset: -50,
                duration: heightDurationSec+600
            })
            .setTween(tlPatchwork2)
            // .addIndicators({ name: '2 (duration: 300)' })
            scrollM.addScene(scenePatchwork2);


            const scenePatchworkImg2 = scrollM.scene({
                triggerElement: ".patchwork-txt",
                triggerHook: 0.65,
                offset: -50,
                duration: heightDurationSec+600
            })
            .setTween(tlImages2)
            // .addIndicators({ name: '22222 (duration: 300)' })
            scrollM.addScene(scenePatchworkImg2);

        }
    }
</script>

<style lang="scss" scoped>
.img-patchwork{
        .container{
            width: 100%;
            max-width: 1134px;
        }
        .img-patchwork-one-container,
        .img-patchwork-two-container{
            position: relative;
            // overflow: hidden;
            display: block;
            height: 670px;
            .img-pachwork-img{
                position: absolute;
                overflow: hidden;
                transition: transform 0.05s ease-in-out;
                img{
                    transform: scale(1.1);
                }
                &:nth-child(1){
                    top: 30px;
                    left: 103px;
                    left: 9%;
                    max-width: 380px;
                }
                &:nth-child(2){
                    right: 0;
                    max-width: 479px;

                }
                &:nth-child(3){
                    left: 0;
                    top: 305px;
                    max-width: 483px;

                }
                &:nth-child(4){
                    top: 220px;
                    left: 502px;
                    left: 44.5%;
                    max-width: 380px;

                }
            }
        }
        .img-patchwork-two-container{
            height: 950px;
            margin-bottom: 50px;
            .img-pachwork-img{
                &:nth-child(1){
                    top: 0;
                    left: 201px;
                }
                &:nth-child(2){
                    top: 100px;
                    right: 90px;
                }
                &:nth-child(3){
                    left: 0;
                    top: 275px;

                }
                &:nth-child(4){
                    right: 200px;
                    top: 435px;
                    max-width: 430px;

                }
                &:nth-child(5){
                    left: 320px;
                    bottom: 0;
                    max-width: 262px;

                }
            }
        }
        .patchwork-txt{
            text-align: center;
            max-width: 765px;
            margin: 110px auto;
            font-size: 28px;
        }
    }

    @media only screen and ( max-width : 768px ) {
        .img-patchwork{
            .img-patchwork-one-container{
                .img-pachwork-img{
                    &:nth-child(3){
                        left: 20px;
                        top: 305px;
                        max-width: 333px;
                    }
                    &:nth-child(2){
                        right: 20px;
                        max-width: 280px;
                        max-height: 270px;
                    }
                    &:nth-child(4){
                        top: 340px;
                        left: 502px;
                        left: 49.5%;
                        max-width: 350px;
                        max-height: 430px;
                    }
                }
            }
            .img-patchwork-two-container{
                margin-bottom: 242px;
                .img-pachwork-img{
                    &:nth-child(1) {
                        top: 0;
                        left: 20px;
                    }
                    &:nth-child(2) {
                        right: 70px;
                        z-index: 9!important;
                    }
                    &:nth-child(3) {
                        left: 9%;
                        top: 425px;
                    }
                    &:nth-child(4) {
                        right: auto;
                        top: 815px;
                        left: 110px;
                    }
                    &:nth-child(5) {
                        left: initial;
                        right: 40px;
                    }
                }
            }
            .patchwork-txt{
                padding: 0 20px;
            }
        }
    }

    @media ( max-width : 680px ) {
        .img-patchwork{
            .img-patchwork-one-container,
            .img-patchwork-two-container{
                position: relative;
                overflow: hidden;
                display: block;
                margin-bottom: 0;
                .img-pachwork-img{
                    &:nth-child(5){
                        display: none;
                    }
                }
            }
            .img-patchwork-one-container{
                height: 1130px;
                .img-pachwork-img{
                    &:nth-child(1){
                        left: 20px;
                        top: 30px;
                        max-width: 80%;
                    }
                    &:nth-child(2){
                        top: 180px;
                    }
                    &:nth-child(3){
                        top: 425px;
                        z-index: 1;
                    }
                    &:nth-child(4){
                        left: 15%;
                        top: 695px;
                        width: 75%;
                        z-index: 0;
                    }
                }
            }
            .img-patchwork-two-container{
                height: 1120px;
                .img-pachwork-img{
                    &:nth-child(2){
                        top: 200px;
                    }
                    &:nth-child(3){
                        top: 485px;
                    }
                    &:nth-child(4){
                        top: 745px;
                        right: 40px;
                        left: auto;
                        max-width: 360px;
                    }
                }
            }
            .patchwork-txt{
                max-width: 80%;
                margin: 70px auto;
                font-size: 18px;
            }
        }
    }
</style>