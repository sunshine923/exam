<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 教师管理</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href="#/manage/teacherAdd"><span class="icon-plus-square-o"></span> 添加内容</a>
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
                <el-table-column
                        prop="tid"
                        label="tid"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="user"
                        label="姓名"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="cname"
                        label="班级"
                        show-overflow-tooltip>
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'teacherUpdate',query:{tid:scope.row.tid}}" class="el-button el-button--default el-button--mini">编辑</router-link>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row.tid)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div style="margin-top: 20px">
                <el-button @click="reverseSelection">反选</el-button>
                <el-button @click="toggleSelection()">取消选择</el-button>
                <el-button @click="totalDelete()">删除</el-button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name:'manageTeacher',
        data(){
            return{
                tableData: [],
                multipleSelection: []
            }
        },
        methods:{
            handleDelete(tid){
                this.$http.post('/home/teacher/teacherDelete.php',{tid}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(ele=>ele.tid != tid)
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
                let ids = this.multipleSelection.map(ele=>ele.tid);
                this.$http.post('/home/teacher/teacherTodel.php',{ids}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(eles=>!ids.includes(eles.tid))
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
            }
        },
        mounted(){
            this.$http.post('/home/teacher/manageTeacher.php').then(res=>{
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