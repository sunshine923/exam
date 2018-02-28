<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 试题管理</strong></div>
            <div class="padding border-bottom">
            </div>
            <el-table
                    max-height="350"
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
                        prop="eid"
                        label="eid">
                </el-table-column>
                <el-table-column
                        prop="title"
                        label="题干">
                </el-table-column>
                <el-table-column
                        prop="pname"
                        label="试卷名称"
                        show-overflow-tooltip>
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
            totalDelete() {
                let ids = this.multipleSelection.map(ele=>ele.eid);
                this.$http.post('/home/test/textDelete.php',{ids}).then(res=>{
                    if(res.body=='ok'){
                        this.tableData = this.tableData.filter(eles=>!ids.includes(eles.eid))
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
            this.$http.post('/home/test/teacherText.php').then(res=>{
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