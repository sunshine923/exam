<template>
    <div id="exam">
        <div class="title"><i class="el-icon-caret-right"></i>试卷列表</div>
         <ul class="list-box">
             <li v-for="item in table" class="list">
                 <router-link :to="{name:'studentPaper',query:{pid:item.pid,pname:item.pname}}">
                     <img src="../../assets/images/11.jpg" alt="">
                     <h1>试卷名称：{{item.pname}} <span>班级：{{cname}}</span></h1>
                 </router-link>
             </li>
         </ul>
    </div>
</template>
<script>
    export default {
        name:'studentExam',
        data(){
            return{
                table:[],
                cname:'',
                user:'',
            }
        },
        mounted(){
            this.$http.post('/home/exam/examTest.php').then(res=>{
                this.cname = res.body[0];
                this.table = res.body[1];
                this.user = res.body[2];
            })
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
    }
</script>
<style scoped>
    *{
        margin: 0;
        padding:0;
        list-style: none;
        text-decoration: none;
    }
    body{
        background: #F5F5F5;
    }
    #exam{
        width:1200px;
        height:auto;
        margin: 0 auto;
    }
    .title{
        width: 100%;
        height: 50px;
        font-size: 16px;
        line-height: 50px;
        color: #333333;
    }
    .list-box{
        width: 1200px;
        border: solid 1px #b5cfd9;
        overflow: hidden;
    }
    .list{
        width: 280px;
        height: 280px;
        transition: all 0.2s linear;
        overflow: hidden;
        margin-right: 25px;
        float: left;
        background: #fff;
        margin-bottom: 25px;
    }
    .list:hover{
        transform: translateY(-2px);
        box-shadow: 0px 15px 15px 5px rgba(224, 224, 224, 0.6);
    }
    .list:nth-of-type(4n){
        margin-right: 0px;
    }
     .list>a{
        width:100%;
        height:100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: #333;
    }
    .list>a>img{
        width:100%;
        height:228px;
    }
    .list>a>h1{
        width:100%;
        height:80px;
        font-weight: normal;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
    }
</style>