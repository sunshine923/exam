<template>
    <div>
        <el-tag>批量添加</el-tag>
        <el-form style="background: rgba(255,255,255,0.4);padding:40px 30px">
        <div @drop="_drop" @dragenter="_suppress" @dragover="_suppress">
            <div class="form-group">
                <label for="file">请选择Excel文件</label>
                <input type="file" class="form-control" id="file" :accept="SheetJSFT" @change="_change" />
            </div>
        </div>
        <el-button type="primary" @click="onSubmitAll()">提交</el-button>
        </el-form>

        <el-tag type="success">单个添加</el-tag>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="名字" prop="user">
                <el-input v-model="form.user"></el-input>
            </el-form-item>
            <el-form-item label="班级" prop="cname">
                <el-select v-model="form.cname" placeholder="请选择班级">
                    <el-option v-for="v in classes" :value="v.cname" :key="v.cid" :label="v.cname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    const _XLSX = require('xlsx');
    const X = typeof XLSX !== 'undefined' ? XLSX : _XLSX;
    const make_cols = refstr => Array(X.utils.decode_range(refstr).e.c + 1).fill(0).map((x,i) => ({name:X.utils.encode_col(i), key:i}));
    /* see Browser download file example in docs */
    function s2ab(s) {
        const buf = new ArrayBuffer(s.length);
        const view = new Uint8Array(buf);
        for (let i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    const _SheetJSFT = [
        "xlsx", "xlsb", "xlsm", "xls", "xml", "csv", "txt", "ods", "fods", "uos", "sylk", "dif", "dbf", "prn", "qpw", "123", "wb*", "wq*", "html", "htm"
    ].map(function(x) { return "." + x; }).join(",");
    export default {
        name:'studentAdd',
        data(){
           return{
               form:{
                   user:'',
                   cname:'',
               },
               rules:{
                   user:[
                       {required: true, message: '请输入名字', trigger: 'blur'},
                       {min: 2, max: 20, message: '长度在 2 到 20 个字符', trigger: 'blur'}
                   ],
                   cname: [
                       { required: true, message: '请选择班级', trigger: 'change' }
                   ],
               },
               classes:[],
               data:[],
               SheetJSFT: _SheetJSFT
           }
        },
        methods:{
            _suppress(evt) { evt.stopPropagation(); evt.preventDefault(); },
            _drop(evt) {
                evt.stopPropagation(); evt.preventDefault();
                const files = evt.dataTransfer.files;
                if(files && files[0]) this._file(files[0]);
            },
            _change(evt) {
                const files = evt.target.files;
                if(files && files[0]) this._file(files[0]);
            },
            _export(evt) {
                /* convert state to workbook */
                const ws = X.utils.aoa_to_sheet(this.data);
                const wb = X.utils.book_new();
                X.utils.book_append_sheet(wb, ws, "SheetJS");
                /* generate X file */
                const wbout = X.write(wb, {type:"binary", bookType:"xlsx"});
                /* send to client */
                saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), "sheetjs.xlsx");
            },
            _file(file) {
                /* Boilerplate to set up FileReader */
                const reader = new FileReader();
                reader.onload = (e) => {
                    /* Parse data */
                    const bstr = e.target.result;
                    const wb = X.read(bstr, {type:'binary'});
                    /* Get first worksheet */
                    const wsname = wb.SheetNames[0];
                    const ws = wb.Sheets[wsname];
                    /* Convert array of arrays */
                    const data = X.utils.sheet_to_json(ws, {header:1});
                    /* Update state */
                    this.data = data;
                    console.log(this.data)
                    this.cols = make_cols(ws['!ref']);
                };
                reader.readAsBinaryString(file);
            },
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/student/studentAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('manageStudent')
                            }else if(res.body=='error'){
                                this.$message({
                                    showClose: true,
                                    message: '添加失败',
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
            onSubmitAll(){
                this.$http.post('/home/student/studentAddAll.php',{data:this.data}).then(res=>{
                    if(res.body=='ok'){
                        this.$router.push('manageStudent')
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message: '添加失败',
                            type: 'warning'
                        });
                    }
                })
            }
        },
        mounted(){
            this.$http.post('/home/classes/manageClasses.php',this.$route.query).then(res=>{
                this.classes = res.body;
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