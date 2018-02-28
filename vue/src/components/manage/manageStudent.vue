<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 学生管理</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href="#/manage/studentAdd"><span class="icon-plus-square-o"></span> 添加内容</a>
            </div>

            <el-table
                    height="250"
                    ref="multipleTable"
                    :data="tableData"
                    tooltip-effect="dark"
                    style="width: 100%"
                    @selection-change="handleSelectionChange">
                <el-table-column
                        type="selection"
                        width="55">
                </el-table-column>
                <el-table-column prop="uid" label="uid"></el-table-column>
                <el-table-column prop="user" label="名字"></el-table-column>
                <el-table-column prop="cname" label="班级"></el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'studentUpdate',query:{uid:scope.row.uid}}" class="el-button el-button--default el-button--mini">编辑</router-link>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row.uid)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div style="margin-top: 20px">
                <el-button @click="reverseSelection()">反选</el-button>
                <el-button @click="toggleSelection()">取消选择</el-button>
                <el-button @click="totalDelete()">删除</el-button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name:'manageStudent',
        data(){
            return{
                tableData: [],
                multipleSelection: [],
            }
        },
        methods:{
            handleDelete(uid){
                this.$http.post('/home/student/studentDelete.php',{uid}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(ele=>ele.uid != uid)
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message: '操作失败',
                            type: 'warning'
                        });
                    }
                })
            },
            totalDelete() {
                let ids = this.multipleSelection.map(ele=>ele.uid);
                this.$http.post('/home/student/studentTodel.php',{ids}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(eles=>!ids.includes(eles.uid))
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message: '操作失败',
                            type: 'warning'
                        });
                    }
                })
            },
            toggleSelection() {
                this.$refs.multipleTable.clearSelection();
            },
            reverseSelection() {
                this.tableData.forEach(ele=>{
                    this.$refs.multipleTable.toggleRowSelection(ele);
                })
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
        },
        mounted(){
            this.$http.post('/home/student/manageStudent.php').then(res=>{
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