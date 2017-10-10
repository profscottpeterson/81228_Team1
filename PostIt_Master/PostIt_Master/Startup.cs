using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(PostIt_Master.Startup))]
namespace PostIt_Master
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
