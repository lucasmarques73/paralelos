using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ProjLocadoraTabajara
{
    public partial class Form1 : Form
    {
        struct Tipofilmes {
            public int codigo;
            public string titulo, genero, direcao, ator, sinopse;        
        }
        Tipofilmes[] filmes = new Tipofilmes[100];
        int contf = 0;

        public Form1()
        {
            InitializeComponent();
        }
        //salvar filmes
        private void button1_Click(object sender, EventArgs e)
        {
            if (contf < 100) {
                filmes[contf].codigo = 
                                Convert.ToInt16(tbcodigo.Text);
                filmes[contf].titulo = tbtitulo.Text;
                filmes[contf].genero = cbgenero.Text;
                filmes[contf].direcao = tbdirecao.Text;
                filmes[contf].ator = tbatores.Text;
                filmes[contf].sinopse = tbsinopse.Text;
                contf++;
                cbfilmes.Items.Add(tbtitulo.Text);
                MessageBox.Show("Dados armazenados com sucesso");
                // chama o método do botão limpar
                button1_Click_1(sender, e);

            }else
                MessageBox.Show("Array abarrotado");
        }

        private void tabPage2_Click(object sender, EventArgs e)
        {

        }

        private void btrbuscarfilme_Click(object sender, EventArgs e)
        {
            bool achou = false;
            for (int i = 0; i < contf; i++) {
                if (filmes[i].titulo.Equals(tbtitulo.Text)) {
                    tbcodigo.Text = ""+filmes[i].codigo;
                    tbdirecao.Text = filmes[i].direcao;
                    tbatores.Text = filmes[i].ator;
                    tbsinopse.Text = filmes[i].sinopse;
                    cbgenero.Text = filmes[i].genero;
                    achou = true;
                    bteditarfilme.Visible = true;
                    btexcluirfilme.Visible = true;
                } // if(filmes....           
            }// for(int i ...
            if (!achou)
                MessageBox.Show("Filme não cadastrado");
        }
        // limpar filmes
        private void button1_Click_1(object sender, EventArgs e)
        {
            tbcodigo.Text = "";
            tbdirecao.Text = "";
            tbatores.Text = "";
            tbsinopse.Text = "";
            cbgenero.Text = "";
            tbtitulo.Text = "";
        }

        private void btexcluirfilme_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < contf; i++) {
                if (filmes[i].codigo == Convert.ToInt16(tbcodigo.Text)) {
                    filmes[i].titulo = "";
                    filmes[i].genero = "";
                    filmes[i].direcao = "";
                    filmes[i].ator = "";
                    filmes[i].sinopse = "";
                    filmes[i].codigo = 0;
                }             
            }
            bteditarfilme.Visible = false;
            btexcluirfilme.Visible = false;
        }
    }
}
