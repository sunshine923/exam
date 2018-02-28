<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 试卷管理</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href="#/teacher/paperAdd"><span class="icon-plus-square-o"></span> 添加试卷</a>
            </div>
            <el-table
                    :data="tableData"
                    stripe
                    style="width: 100%">
                <el-table-column prop="pid" label="pid"></el-table-column>
                <el-table-column prop="pname" label="试卷名称"></el-table-column>
                <el-table-column prop="cname" label="班级名称"></el-table-column>
                <el-table-column prop="author" label="命题人"></el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'paperUpdate',query:{pid:scope.row.pid}}" class="el-button el-button--default el-button--mini">编辑</router-link>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row.pid)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>
<script>
    export default {
        name:'teacherPaper',
        data(){
            return{
                tableData: []
            }
        },
        methods:{
            handleDelete(pid){
                this.$http.post('/home/test/paperDelete.php',{pid}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(ele=>ele.pid != pid)
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
            this.$http.post('/home/test/teacherPaper.php').then(res=>{
                this.tableData=res.body;
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