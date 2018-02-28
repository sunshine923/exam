<template>
    <div id="box">
        <div class="header bg-main">
                <div id="content">
                <div class="logo  fadein-top">
                    <h1><img src="../../assets/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="">试题评测</h1>
                </div>
                <div class="right">
                    <ul class="item">
                        <li>
                            <router-link :to="{name:'studentExam'}">试卷</router-link>
                        </li>
                        <li>
                            <router-link :to="{name:'studentRecord'}">历史记录</router-link>
                        </li>
                    </ul>
                    <ul class="info">
                        <li>
                            <router-link to="aa"><i class="el-icon-info"></i> {{user}}</router-link>
                        </li>
                        <li>
                            <el-button type="danger" plain @click="exit">退出登录</el-button>
                        </li>
                    </ul>
                </div>
                </div>
    </div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name:'student',
        data(){
            return{
                user:'',
            }
        },
        beforeCreate(){
            if(!localStorage.student){
                this.$message({
                    showClose: true,
                    message: '请先登录',
                    type: 'warning'
                });
                this.$router.push({name:'login'})
            }
        },
        methods:{
            exit(){
                localStorage.removeItem('student')
                this.$http.post('/home/exit.php').then(res=>{
                    if(res.body=='ok'){
                        this.$router.push({name:'login'})
                    }
                })
            }
        },
        mounted(){
            this.$http.post('/home/exam/examTest.php').then(res=>{
                this.user = res.body[2];
            })
        }
    }
</script>
<style>
    *{
        margin: 0;
        padding:0;
        list-style: none;
        text-decoration: none;
    }
    #content{
        width:1200px;
        height:100%;
        margin: 0 auto;
        display: flex;
        align-items: center;
    }
    .header {
        width:100%;
        height:60px;
        overflow:hidden;
        background:url(../../assets/images/bg.jpg) no-repeat 0 -1000px;
        position: fixed;
        top:0;
        left:0;
        z-index: 999;
    }
    .logo{ float:left; color:#FFF; line-height:45px;}
    .logo img{ float:left; margin-right:10px;border-radius: 50%}
    .fadein-top{-webkit-animation:1s ease-out backwards;-moz-animation:1s ease-out backwards;-ms-animation:1s ease-out backwards;animation:1s ease-out backwards;}
    h1{font-size:14px;font:inherit;vertical-align:baseline;}
    .right{
        display: flex;
        flex: 1;
        justify-content: flex-end;
        align-items: center;
    }
    .item,.info{
        display: flex;
        align-items: center;
        margin-right: 20px;
    }
    .item>li,.info>li{
        margin: 0 10px;
    }
    .item>li>a,.info>li>a{
        color: #fff;
    }
    .item>li>a:hover,.info>li>a:hover{
        color: #409EFF;
    }
</style>