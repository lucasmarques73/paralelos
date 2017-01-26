using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace tbMensagem
{
    public partial class Mensagem : Form
    {

        string remetente = "";
        public Mensagem()
        {
            InitializeComponent();
        }

        public Mensagem(string email)
          {
              remetente = email;
                InitializeComponent();
          }

        private void label2_Click(object sender, EventArgs e)
        {
                
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void btEnviar_Click(object sender, EventArgs e)
        {       


            /*  Conectar com o bd
             *  mostrar a qiery de inserção
             * passar parametro  - nao esquecer remetende
             * executar query - 
             * */

        }
    }
}
