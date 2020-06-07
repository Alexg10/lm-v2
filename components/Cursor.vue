<template>
    <div class="cursor"></div>
</template>

<script>
    export default {
        methods: {
            cursor(){
                const cursor = document.querySelector('.cursor');
                var mouseX = 0, mouseY = 0;
                var xp = 0, yp = 0;
                document.addEventListener('mousemove', function(e){
                    mouseX = e.clientX;
                    mouseY = e.clientY; 
                });
                setInterval(function(){
                    xp += ((mouseX - xp)/6);
                    yp += ((mouseY - yp)/6);
                    cursor.style.left = xp +'px';
                    cursor.style.top = yp +'px';
                }, 25);
            },
            cursorHover(){
                var link = document.getElementsByClassName("link-hover");
                var hoverAddClassFunction = function() {
                    document.querySelector('.cursor').classList.add('hover');
                };
                var hoverRemoveClassFunction = function() {
                    document.querySelector('.cursor').classList.remove('hover');
                };

                for (var i = 0; i < link.length; i++) {
                    link[i].addEventListener('mouseenter', hoverAddClassFunction);
                    link[i].addEventListener('mouseleave', hoverRemoveClassFunction);
                }
            }
        },
        mounted() {
            this.cursor();
            this.cursorHover();
        }
    }
</script>

<style lang="scss" scoped>
    .cursor{
        position: fixed;
        width: 40px;
        height: 40px;
        background: transparent;
        border: 1px solid #FF9170;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
        pointer-events: none;
        transition: width 0.4s ease, height 0.4s ease, border 1s ease 0.7s;
        &.hover{
            width: 20px;
            height: 20px;
            transition: width 0.4s ease, height 0.4s ease;
        }
        &.transparent{
            border: 1px solid transparent;
            transition: border 0.4s ease;


            
        }
    }
</style>