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
        ]
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