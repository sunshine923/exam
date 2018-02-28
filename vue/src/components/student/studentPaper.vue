<template>
    <div id="exam">
        <el-form ref="form" :model="form" label-width="80px" style="background: rgba(255,255,255,0.4);">
            <header>
                <div class="title">
                    试卷名称:{{pname}}
                    <el-button type="primary" @click="submit">提交</el-button>
                </div>
            </header>
            <ul class="content">
                <li v-for="(item,index) in tableData" :key="index">
                    <span>{{index+1}}、{{item.title}}({{item.score}}分)</span>
                    <ul v-if="item.type==1" class="a">
                        <el-radio-group v-model="form['title'+index]">
                            <el-radio v-for="v in item.options" :label="v['keys']" :key="v.keys">{{v.keys}}、{{v.values}}</el-radio>
                        </el-radio-group>
                    </ul>
                    <ul v-else-if="item.type==2" class="a">
                        <el-checkbox-group v-model="form['title'+index]">
                            <el-checkbox v-for="v in item.options" :key="v['keys']" :label="v['keys']">{{v.keys}}、{{v['values']}}</el-checkbox>
                        </el-checkbox-group>
                    </ul>
                    <ul v-else-if="item.type==3" class="a">
                         <el-input type="textarea" v-model="form['title'+index]"></el-input>
                    </ul>
                </li>
            </ul>
        </el-form>

    </div>
</template>
<script>
    export default {
        name:'studentExam',
        data(){
            return{
                tableData5:[],
                pname:'',
                form:{
                }
            }
        },
        computed:{
            tableData(){
                let tableData=[];
                this.tableData5.forEach(ele=>{
                    let v = ele.title.split('_');
                    let title = v[0];
                    let options = [];
                    if(v[1]){
                        let arr = v[1].split('|');
                        arr.forEach(ele=>{
                            options.push({keys:ele.split(':')[0],values:ele.split(':')[1]})
                        })
                    }else{
                        options='';
                    }
                    tableData.push({title,options,type:ele.type,score:ele.score})
                })
                return tableData;
            }
        },
        methods:{
            submit(){
                let ids = this.tableData5.map(ele=>ele.tid);
                this.$http.post('home/exam/insertRecord.php',{ids,pid:this.$route.query.pid,answer:this.form}).then(res=>{
                    if(res.body=='ok'){
                        this.$router.push('studentRecord');
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message: '提交失败',
                            type: 'warning'
                        });
                    }
                })
            }
        },
        mounted(){
            this.pname = this.$route.query.pname;
            this.$http.post('/home/exam/examPaper.php',this.$route.query).then(res=>{
                let obj={};
                this.tableData5 = res.body.sort((a,b)=>a.type-b.type);
                for(let i=0;i<this.tableData5.length;i++){
                    if(this.tableData5[i].type==1 || this.tableData5[i].type==3){
                        obj['title'+i]='';
                    }else if(this.tableData5[i].type==2) {
                        obj['title' + i] = [];
                    }
                }
                this.form = obj;
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
<style>
    *{
        margin: 0;
        padding:0;
        list-style: none;
        text-decoration: none;
    }
    #exam{
        width:1200px;
        height:auto;
        margin: 0 auto;
    }
    header{
        width: 100%;
        height: 50px;
        background: #fff;
        box-shadow: 0px 5px 15px 5px rgba(224, 224, 224, 0.6);
        position: fixed;
        top:60px;
        left: 0;
        z-index:999;
    }
    .title{
        width:1200px;
        height:100%;
        margin: 0 auto;
        font-size: 16px;
        line-height: 50px;
        color: #333333;
        display: flex;
        justify-content:space-between;
        align-items: center;
    }
    .content{
        width:1200px;
        height:auto;
        margin-top: 140px;
    }
    .content>li{
        width:100%;
        height:200px;
        border: 1px solid #dddddd;
        margin-bottom: 10px;
    }
    .a{
        margin-top: 20px;
        margin-left: 10px;
    }
</style>