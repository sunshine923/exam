<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 方向管理</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href="#/manage/dirAdd"><span class="icon-plus-square-o"></span> 添加内容</a>
            </div>
            <el-table
                    :data="tableData"
                    stripe
                    style="width: 100%">
                <el-table-column prop="did" label="did"></el-table-column>
                <el-table-column prop="dname" label="方向名称"></el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'dirUpdate',query:{did:scope.row.did}}" class="el-button el-button--default el-button--mini">编辑</router-link>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row.did)">删除</el-button>
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
                tableData: []
            }
        },
        methods:{
            handleDelete(did){
                this.$http.post('/home/direction/dirDelete.php',{did}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(ele=>ele.did != did)
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
            this.$http.post('/home/direction/manageDir.php').then(res=>{
                this.tableData=res.body;
            })
        },
        beforeCreate(){
            if(!localStorage.admin){
                this.$message({
                    showClose: true,
                    message: '请先登录',
                    type: 'warning'
                });
                this.$router.push({name:'login'})
            }
        }
    }
</script>
<style>

</style>