export default {
    data(){
        return {
            products:[]
        }
    },
    methods:{
        apiCall: async (pMethod, pUrl, pData) => {
            try{
                let reuest = axios({
                    method:pMethod,
                    url: pUrl,
                    data: pData
                });
                return
            }
            catch(e){
                return e.response
            }
        }
    }
};
