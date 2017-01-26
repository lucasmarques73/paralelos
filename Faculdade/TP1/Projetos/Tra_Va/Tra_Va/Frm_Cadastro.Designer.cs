namespace Tra_Va
{
    partial class Frm_Cadastro
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.cbx_setor = new System.Windows.Forms.ComboBox();
            this.tbx_cpf = new System.Windows.Forms.TextBox();
            this.tbx_nome = new System.Windows.Forms.TextBox();
            this.tbx_senhaC = new System.Windows.Forms.TextBox();
            this.tbx_loginC = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.dtp_dataNasc = new System.Windows.Forms.DateTimePicker();
            this.tbx_confSenha = new System.Windows.Forms.TextBox();
            this.bt_salvar = new System.Windows.Forms.Button();
            this.bt_limpar = new System.Windows.Forms.Button();
            this.bt_sair = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(38, 47);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(27, 13);
            this.label1.TabIndex = 0;
            this.label1.Text = "CPF";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(38, 102);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(89, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "Data Nascimento";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(38, 73);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(35, 13);
            this.label3.TabIndex = 2;
            this.label3.Text = "Nome";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(40, 125);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(33, 13);
            this.label4.TabIndex = 3;
            this.label4.Text = "Login";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(38, 151);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(38, 13);
            this.label5.TabIndex = 4;
            this.label5.Text = "Senha";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(38, 203);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(35, 13);
            this.label6.TabIndex = 5;
            this.label6.Text = "Setor ";
            // 
            // cbx_setor
            // 
            this.cbx_setor.FormattingEnabled = true;
            this.cbx_setor.Location = new System.Drawing.Point(85, 200);
            this.cbx_setor.Name = "cbx_setor";
            this.cbx_setor.Size = new System.Drawing.Size(121, 21);
            this.cbx_setor.TabIndex = 6;
            // 
            // tbx_cpf
            // 
            this.tbx_cpf.Location = new System.Drawing.Point(73, 44);
            this.tbx_cpf.Name = "tbx_cpf";
            this.tbx_cpf.Size = new System.Drawing.Size(133, 20);
            this.tbx_cpf.TabIndex = 7;
            // 
            // tbx_nome
            // 
            this.tbx_nome.Location = new System.Drawing.Point(73, 70);
            this.tbx_nome.Name = "tbx_nome";
            this.tbx_nome.Size = new System.Drawing.Size(133, 20);
            this.tbx_nome.TabIndex = 8;
            // 
            // tbx_senhaC
            // 
            this.tbx_senhaC.Location = new System.Drawing.Point(105, 148);
            this.tbx_senhaC.Name = "tbx_senhaC";
            this.tbx_senhaC.Size = new System.Drawing.Size(100, 20);
            this.tbx_senhaC.TabIndex = 9;
            // 
            // tbx_loginC
            // 
            this.tbx_loginC.Location = new System.Drawing.Point(106, 122);
            this.tbx_loginC.Name = "tbx_loginC";
            this.tbx_loginC.Size = new System.Drawing.Size(100, 20);
            this.tbx_loginC.TabIndex = 10;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Location = new System.Drawing.Point(38, 182);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(82, 13);
            this.label7.TabIndex = 11;
            this.label7.Text = "Confirma Senha";
            // 
            // dtp_dataNasc
            // 
            this.dtp_dataNasc.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtp_dataNasc.Location = new System.Drawing.Point(133, 96);
            this.dtp_dataNasc.Name = "dtp_dataNasc";
            this.dtp_dataNasc.Size = new System.Drawing.Size(72, 20);
            this.dtp_dataNasc.TabIndex = 12;
            // 
            // tbx_confSenha
            // 
            this.tbx_confSenha.Location = new System.Drawing.Point(126, 174);
            this.tbx_confSenha.Name = "tbx_confSenha";
            this.tbx_confSenha.Size = new System.Drawing.Size(80, 20);
            this.tbx_confSenha.TabIndex = 13;
            // 
            // bt_salvar
            // 
            this.bt_salvar.Location = new System.Drawing.Point(222, 42);
            this.bt_salvar.Name = "bt_salvar";
            this.bt_salvar.Size = new System.Drawing.Size(75, 23);
            this.bt_salvar.TabIndex = 14;
            this.bt_salvar.Text = "Salvar ";
            this.bt_salvar.UseVisualStyleBackColor = true;
            // 
            // bt_limpar
            // 
            this.bt_limpar.Location = new System.Drawing.Point(222, 73);
            this.bt_limpar.Name = "bt_limpar";
            this.bt_limpar.Size = new System.Drawing.Size(75, 23);
            this.bt_limpar.TabIndex = 15;
            this.bt_limpar.Text = "Limpar";
            this.bt_limpar.UseVisualStyleBackColor = true;
            // 
            // bt_sair
            // 
            this.bt_sair.Location = new System.Drawing.Point(222, 102);
            this.bt_sair.Name = "bt_sair";
            this.bt_sair.Size = new System.Drawing.Size(75, 23);
            this.bt_sair.TabIndex = 16;
            this.bt_sair.Text = "Sair";
            this.bt_sair.UseVisualStyleBackColor = true;
            this.bt_sair.Click += new System.EventHandler(this.bt_sair_Click);
            // 
            // Frm_Cadastro
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(381, 246);
            this.Controls.Add(this.bt_sair);
            this.Controls.Add(this.bt_limpar);
            this.Controls.Add(this.bt_salvar);
            this.Controls.Add(this.tbx_confSenha);
            this.Controls.Add(this.dtp_dataNasc);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.tbx_loginC);
            this.Controls.Add(this.tbx_senhaC);
            this.Controls.Add(this.tbx_nome);
            this.Controls.Add(this.tbx_cpf);
            this.Controls.Add(this.cbx_setor);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Frm_Cadastro";
            this.Text = "Cadastro";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.ComboBox cbx_setor;
        private System.Windows.Forms.TextBox tbx_cpf;
        private System.Windows.Forms.TextBox tbx_nome;
        private System.Windows.Forms.TextBox tbx_senhaC;
        private System.Windows.Forms.TextBox tbx_loginC;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.DateTimePicker dtp_dataNasc;
        private System.Windows.Forms.TextBox tbx_confSenha;
        private System.Windows.Forms.Button bt_salvar;
        private System.Windows.Forms.Button bt_limpar;
        private System.Windows.Forms.Button bt_sair;
    }
}