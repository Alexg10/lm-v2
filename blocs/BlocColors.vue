<template>
    <section v-if="bloc" class="color-section">
        <div class="container">
            <div class="color-section-container">
                <div class="color-container" v-for="color in bloc.blocColorsColor" v-bind:key>
                    <div class="color" v-bind:style="{background: color.colorHexa}"></div>
                    <div class="color-name">
                        {{color.colorTitle}} - {{color.colorHexa}}
                    </div>
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
    .color-section{
        padding: 90px 0 110px;
        .color-section-container{
            display: flex;
            justify-content: center;
            .color-container{
                padding: 0 62px;
                text-align: center;
            }
        }
        .color{
            width: 80px;
            height: 80px;
            margin: 0 auto;
            margin-bottom: 25px;
            border-radius: 100px;
        }
        .color-name{
            font-family: 'GTWalsheimProRegular';
        }
        @media only screen and ( max-width : 768px ) {
            .color-section-container{
                flex-wrap: wrap;
                overflow: hidden;
                .color-container{
                    padding: 0 22px;
                    margin-bottom: 30px;
                }
            }
        }
        @media only screen and ( max-width : 680px ) {

        }
    }
</style>