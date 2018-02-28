<template>
    <div>
        <div class="header bg-main">
            <div class="logo margin-big-left fadein-top">
                <h1><img src="../../assets/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" width="50"/>后台管理中心</h1>
            </div>
            <div class="head-l"><a class="button button-little bg-red" @click="exit"><span class="icon-power-off"></span> 退出登录</a> </div>
        </div>
        <div class="leftnav">
            <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
            <h2><span class="icon-user"></span>基本设置</h2>
            <ul style="display:block">
                <li><a href="#/teacher/teacherPass"><span class="icon-caret-right"></span>修改密码</a></li>
            </ul>
            <h2><span class="icon-user"></span>功能设置</h2>
            <ul style="display:block">
                <li><router-link :to="{name:'teacherType'}"><span class="icon-caret-right"></span>题型管理</router-link></li>
                <li><a href="#/teacher/teacherTest"><span class="icon-caret-right"></span>题库管理</a></li>
                <li><a href="#/teacher/teacherPaper"><span class="icon-caret-right"></span>试卷管理</a></li>
                <li><a href="#/teacher/teacherText"><span class="icon-caret-right"></span>试题管理</a></li>
            </ul>
        </div>
        <ul class="bread">
            <li><a href="{:U('Index/info')}" target="right" class="icon-home"> 首页</a></li>

        </ul>
        <div class="admin" style="top: 120px">
           <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        name:'manage',
        beforeCreate(){
            if(!localStorage.teacher){
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
                localStorage.removeItem('teacher')
                this.$http.post('/home/exit.php').then(res=>{
                    if(res.body=='ok'){
                        this.$router.push({name:'login'})
                    }
                })
            }
        },
    }
</script>
<style>
    @import "../../assets/css/admin.css";
    @import "../../assets/css/pintuer.css";
</style>