using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Exercicio1
{

    
    public partial class MenuPrincipal : Form
    {
        int contAlu = 0, contDisci = 0;
        


        struct TipoDisciplinas
        {
            public int cod;
            public string nome;
            public double P1 , P2 , P3 , T1 , T2,  T3;
        }
       // int qtAlu = 300, qtDisci = 2000;
        TipoDisciplinas[] disciplinas = new TipoDisciplinas[2000];
        struct TipoAlunos
        {
           public int numero;
           public string nome, curso;
           public string disciplina;
        }
        TipoAlunos[] alunos = new TipoAlunos [300];
        
        public MenuPrincipal()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

      
        private void btFechar_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void btSalvar_Click(object sender, EventArgs e)
        {

            bool cadastroAluno = false;
            
            
            if (contAlu < 300)
            {
                alunos[contAlu].numero = Convert.ToInt16(tbNumero.Text);
                alunos[contAlu].nome = tbNome.Text;
                alunos[contAlu].curso = tbCurso.Text;
                alunos[contAlu].disciplina = tbDisciplina.Text;

                contAlu++;
                cadastroAluno = true;
            }
            else
            {
                MessageBox.Show("Não permitido mais cadastro de alunos!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }

           
            if (cadastroAluno == true)
            MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);

          //   btLimparAluno_Click(sender, e);
        }

        private void btBuscar_Click(object sender, EventArgs e)
        {
            bool achouAluno = false;
            bool achouDisciplina = false;

            if ((tbNumero.Text != "") && (tbDisciplina.Text != ""))
            {
                 for (int i = 0; i < contAlu; i++)
                     {
                          if (alunos[i].numero.Equals(Convert.ToInt16(tbNumero.Text)))
                              {
                                 tbNumero.Text = ""+alunos[i].numero;
                                 tbNome.Text =  alunos[i].nome ;
                                 tbCurso.Text = alunos[i].curso;
                                 tbDisciplina.Text= alunos[i].disciplina ;
                  
                                 achouAluno = true;
                                 btAlterarAluno.Visible = true;
                                 btExcluirAluno.Visible = true;
                             } //fim if            
                         }// fim for

            if (!achouAluno)
                MessageBox.Show("Aluno Não Encontrado!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);


            for (int i = 0; i < contDisci; i++)
            {
                if (disciplinas[i].nome.Equals(tbDisciplina.Text))
                {
                    tbP1.Text = "" + disciplinas[contDisci].P1;
                    tbP2.Text = "" + disciplinas[contDisci].P2;
                    tbP3.Text = "" + disciplinas[contDisci].P3;
                    tbT1.Text = "" + disciplinas[contDisci].T1;
                    tbT2.Text = "" + disciplinas[contDisci].T2;
                    tbT3.Text = "" + disciplinas[contDisci].T3;

                    achouDisciplina = true;
                    
                     }//fim ir
                 }// fim for
                if (!achouDisciplina)
                    MessageBox.Show("Disciplina Não Encontrada!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }

            else 
            {
                MessageBox.Show("Busca Não Permitida!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            
        }

        private void btExcluir_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < contAlu; i++)
            {
                if (alunos[i].numero == Convert.ToInt16(tbNumero.Text))
                {
                    alunos[i].numero = 0;
                    alunos[i].nome = "";
                    alunos[i].curso = "";
                    alunos[i].disciplina = "";
  
                }
                
                
            }

            btLimparAluno_Click(sender, e);
        }

        private void btSalvarDisciplina_Click(object sender, EventArgs e)
        {
            if (tbNome.Text == "")
            {
                MessageBox.Show("Digite o nome do Aluno!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);

            }
            else
            {
                bool cadastroDisciplina = false;

                disciplinas[contDisci].P1 = 0;
                disciplinas[contDisci].P2 = 0;
                disciplinas[contDisci].P3 = 0;
                disciplinas[contDisci].T1 = 0;
                disciplinas[contDisci].T2 = 0;
                disciplinas[contDisci].T3 = 0;

                if ((tbP1.Text == "") || (tbP2.Text == "") || (tbP3.Text == "") || (tbT1.Text == "") || (tbT2.Text == "") || (tbT3.Text == ""))
                {

                    MessageBox.Show("Algumas Notas podem estar em branco!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);

                }
                else
                {
                    if (contDisci < 2000)
                    {
                        disciplinas[contDisci].cod = Convert.ToInt16(tbCodDisciplina.Text);
                        disciplinas[contDisci].nome = tbDisciplina.Text;
                        disciplinas[contDisci].P1 = Convert.ToDouble(tbP1.Text);
                        disciplinas[contDisci].P2 = Convert.ToDouble(tbP2.Text);
                        disciplinas[contDisci].P3 = Convert.ToDouble(tbP3.Text);
                        disciplinas[contDisci].T1 = Convert.ToDouble(tbT1.Text);
                        disciplinas[contDisci].T2 = Convert.ToDouble(tbT2.Text);
                        disciplinas[contDisci].T3 = Convert.ToDouble(tbT3.Text);

                        contDisci++;
                        cadastroDisciplina = true;
                    }

                    else
                    {
                        MessageBox.Show("Não permitido mais cadastro de disciplinas!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                    }
                }
                if (cadastroDisciplina == true)
                    MessageBox.Show("Salvo com sucesso!", "info", MessageBoxButtons.OK, MessageBoxIcon.Information);

            }
            btLimparDisciplina_Click(sender, e);
        }

        private void btExcluirDisciplina_Click(object sender, EventArgs e)
        {
            
            for (int i = 0; i < contDisci; i++)
			{
                if (disciplinas[i].cod == Convert.ToInt16(tbCodDisciplina.Text))
                {
                    disciplinas[i].cod = 0;
                    disciplinas[i].nome = "";
                    disciplinas[i].P1 = 0;
                    disciplinas[i].P2 = 0;
                    disciplinas[i].P3 = 0;
                    disciplinas[i].T1 = 0;
                    disciplinas[i].T2 = 0;
                    disciplinas[i].T3 = 0;
                }
			}
           

            btLimparDisciplina_Click(sender, e);
           
        }


        private void btLimparAluno_Click(object sender, EventArgs e)
        {
            tbNumero.Text = "";
            tbNome.Text = "";
            tbCurso.Text = "";
           // tbDisciplina.Text = "";

        }

        private void btLimparDisciplina_Click(object sender, EventArgs e)
        {
            tbCodDisciplina.Text = "";
            tbDisciplina.Text = "";
            tbP1.Text = "";
            tbP2.Text = "";
            tbP3.Text = "";
            tbT1.Text = "";
            tbT2.Text = "";
            tbT3.Text = "";
        }

        private void btBuscarAlunos_Click(object sender, EventArgs e)
        {
            bool achouAluno = false;

            for (int i = 0; i < contAlu; i++)
            {
                if ((alunos[i].numero.Equals(Convert.ToInt16(tbNumero.Text))) ||(alunos[i].nome.Equals(tbNumero.Text) ))
                {
                    tbNumero.Text = "" + alunos[i].numero;
                    tbNome.Text = alunos[i].nome;
                    tbCurso.Text = alunos[i].curso;
                    tbDisciplina.Text = alunos[i].disciplina;

                    achouAluno = true;
                    
                } //fim if            
            }// fim for
            if (!achouAluno)
                MessageBox.Show("Aluno Não Encontrado!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);

        }

        private void btAlterarAluno_Click(object sender, EventArgs e)
        {
           
            
            for (int i = 0; i < contAlu; i++)
            {
                if (alunos[i].numero.Equals(Convert.ToInt16(tbNumero.Text)))
                {
                    alunos[i].numero = Convert.ToInt16(tbNumero.Text);
                    alunos[i].nome = tbNome.Text;
                    alunos[i].curso = tbCurso.Text;
                    alunos[i].disciplina = tbDisciplina.Text;

                } //fim if            
            }// fim for

            btLimparAluno_Click(sender, e);
        }

        private void btBuscarDisciplina_Click(object sender, EventArgs e)
        {

              bool achouDisciplina = false;

              if (tbNome.Text == "")
              {
                  MessageBox.Show("Digite o nome do Aluno!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);

              }
              else
              {
                  for (int i = 0; i < contDisci; i++)
                  {
                      if (disciplinas[i].nome.Equals(tbDisciplina.Text))
                      {
                          tbP1.Text = "" + disciplinas[i].P1;
                          tbP2.Text = "" + disciplinas[i].P2;
                          tbP3.Text = "" + disciplinas[i].P3;
                          tbT1.Text = "" + disciplinas[i].T1;
                          tbT2.Text = "" + disciplinas[i].T2;
                          tbT3.Text = "" + disciplinas[i].T3;

                          achouDisciplina = true;

                      }//fim ir
                  }// fim for
                  if (!achouDisciplina)
                      MessageBox.Show("Disciplina Não Encontrada!", "info", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            
              }
              

        }

        private void btAlterarDisciplina_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < contDisci; i++)
            {
                if (disciplinas[i].nome.Equals(tbDisciplina.Text))
                {
                    disciplinas[i].cod = Convert.ToInt16(tbCodDisciplina.Text);
                    disciplinas[i].nome = tbDisciplina.Text;
                    disciplinas[i].P1 = Convert.ToDouble(tbP1.Text);
                    disciplinas[i].P2 = Convert.ToDouble(tbP2.Text);
                    disciplinas[i].P3 = Convert.ToDouble(tbP3.Text);
                    disciplinas[i].T1 = Convert.ToDouble(tbT1.Text);
                    disciplinas[i].T2 = Convert.ToDouble(tbT2.Text);
                    disciplinas[i].T3 = Convert.ToDouble(tbT3.Text);

                   

                }//fim ir
            }// fim for
        }

        private void btBuscarTodosAlunos_Click(object sender, EventArgs e)
        {
            string ListaAlunos = "";

             for (int i = 0; i < contDisci; i++)
            {
                if (disciplinas[i].nome.Equals(tbDisciplina.Text))
                {
                 
                          for (int x = 0; x < contAlu; x++)
                     {
                             if (alunos[i].disciplina.Equals(tbDisciplina.Text))
                                     {


                                   ListaAlunos =  "Nome:" +alunos[i].nome +"Disciplina: "+ alunos[i].disciplina +" \n";

                                      } //fim if            
                                    }// fim for
                    
                    
                     }//fim ir
                 }// fim for



             MessageBox.Show(ListaAlunos, "info", MessageBoxButtons.OK);
            
            }
            
    }
}
