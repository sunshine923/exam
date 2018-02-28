<template>
    <div>
        <el-tag type="success">请添加试题</el-tag>
        <el-table
            :data="tableData"
            max-height="400"
            style="width: 100%"
            ref="multipleTable"
            @selection-change="handleSelectionChange">
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
                type="selection"
                width="55">
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
    </el-table>
        <div style="margin-top: 20px">
            <el-button @click="reverseSelection">反选</el-button>
            <el-button @click="toggleSelection()">取消选择</el-button>
            <el-button @click="totalAdd()">添加</el-button>
        </div>
        <el-tag style="margin-top: 20px">修改试卷信息</el-tag>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="pid">
                {{form.pid}}
            </el-form-item>
            <el-form-item label="班级" prop="cid">
                <el-select v-model="form.cid" placeholder="请选择班级">
                    <el-option v-for="v in classes" :value="v.cid" :key="v.cid" :label="v.cname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="试卷名称" prop="pname">
                <el-input v-model="form.pname" placeholder="请输入试卷名称"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">提交</el-button>
            </el-form-item>
        </el-form>

    </div>
</template>
<script>
    export default {
        name:'paperUpdate',
        data(){
           return{
               form:{
                   pid:'',
                   cid:'',
                   pname:'',
               },
               rules:{
                   cid:[
                       {required: true, message: '请选择班级', trigger: 'change'},
                   ],
                   pname:[
                       {required: true, message: '请输入试卷名称', trigger: 'blur'},
                   ],
               },
               classes:[],
               tableData5: [],
               multipleSelection: []
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
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/test/paperUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('teacherPaper')
                            }else if(res.body=='error'){
                                this.$message({
                                    showClose: true,
                                    message: '修改失败',
                                    type: 'warning'
                                });
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            totalAdd(){
                let ids = this.multipleSelection.map(ele=>ele.tid);
               this.$http.post('/home/test/textAdd.php',{tid:ids,pid:this.form.pid}).then(res=>{
                  if(res.body==1){
                      this.$message({
                          showClose: true,
                          message: '选择题目已存在，请重新选择',
                          type: 'warning'
                      });
                  }else if(res.body=='ok'){
                      this.$message({
                          showClose: true,
                          message: '添加成功',
                          type: 'success'
                      });
                  }else if(res.body=='error'){
                      this.$message({
                          showClose: true,
                          message: '添加失败',
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
            this.$http.post('/home/test/paperQuery.php',this.$route.query).then(res=>{
                this.form = res.body;
            }),
            this.$http.post('/home/classes/manageClasses.php').then(res=>{
                this.classes=res.body;
            }),
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