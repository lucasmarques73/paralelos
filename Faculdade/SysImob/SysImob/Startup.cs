using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(SysImob.Startup))]
namespace SysImob
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
