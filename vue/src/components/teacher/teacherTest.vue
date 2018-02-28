<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 试题管理</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href="#/teacher/testAdd"><span class="icon-plus-square-o"></span> 添加内容</a>
            </div>
            <el-table
                    :data="tableData"
                    height="400"
                    style="width: 100%">
                <el-table-column type="expand">
                    <template slot-scope="props">
                        <el-form label-position="left" inline class="demo-table-expand">
                            <el-form-item label="命题人">
                                <span>{{ props.row.author }}</span>
                            </el-form-item><br>
                            <el-form-item label="解析">
                                <span>{{ props.row.exp }}</span>
                            </el-form-item><br>
                            <div v-if="props.row.options">
                                <el-form-item label="选项">
                                    <el-form-item v-for="item in props.row.options" :key="item">
                                        {{item}}
                                    </el-form-item>
                                </el-form-item>
                            </div>
                        </el-form>
                    </template>
                </el-table-column>
                <el-table-column
                        label="tid"
                        prop="tid">
                </el-table-column>
                <el-table-column
                        label="题干"
                        prop="title">
                </el-table-column>
                <el-table-column
                        label="答案"
                        prop="answer">
                </el-table-column>
                <el-table-column
                        label="类型"
                        prop="name">
                </el-table-column>
                <el-table-column
                        label="分数"
                        prop="score">
                </el-table-column>
                <el-table-column
                        label="阶段"
                        prop="sname">
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'testUpdate',query:{tid:scope.row.tid}}" class="el-button el-button--default el-button--mini">编辑</router-link>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row.tid)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>
<script>
    export default {
        name:'manageDir',
        data(){
            return{
                tableData5: []
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
                        for(let i=0;i<arr.length;i++){
                            options.push(arr[i])
                        }
                    }else{
                        options='';
                    }
                    tableData.push({tid:ele.tid,title,options,answer:ele.answer,exp:ele.exp,name:ele.name,author:ele.author,score:ele.score,sname:ele.sname})
                })
                return tableData;
            }
        },
        methods:{
            handleDelete(tid){
                this.$http.post('/home/test/testDelete.php',{tid}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData5 = this.tableData5.filter(ele=>ele.tid != tid)
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message: '操作失败',
                            type: 'warning'
                        });
                    }
                })
            }
        },
        mounted(){
            this.$http.post('/home/test/teacherTest.php').then(res=>{
                this.tableData5=res.body;
            })
        },
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
}
</script>
<style>

</style>