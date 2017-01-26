using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(testeSemIIS.Startup))]
namespace testeSemIIS
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
