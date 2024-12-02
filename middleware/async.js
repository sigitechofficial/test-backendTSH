module.exports = function asynMiddleware(handler){
    return async (req, res, next)=>{
        try{
           await handler(req, res);
        }
        catch(ex){
            console.error('Async Middleware', ex);
            next(ex);
        }
    }
};