namespace login_acesso_2
{
    partial class Form1
    {
        /// <summary>
        /// Variável de designer necessária.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Limpar os recursos que estão sendo usados.
        /// </summary>
        /// <param name="disposing">verdade se for necessário descartar os recursos gerenciados; caso contrário, falso.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region código gerado pelo Windows Form Designer

        /// <summary>
        /// Método necessário para suporte do Designer - não modifique
        /// o conteúdo deste método com o editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            this.btSair = new System.Windows.Forms.Button();
            this.btAcessar = new System.Windows.Forms.Button();
            this.tbsenha = new System.Windows.Forms.TextBox();
            this.tblogin = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.btNovo = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(204, 104);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(51, 23);
            this.btSair.TabIndex = 35;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btAcessar
            // 
            this.btAcessar.Location = new System.Drawing.Point(141, 104);
            this.btAcessar.Name = "btAcessar";
            this.btAcessar.Size = new System.Drawing.Size(57, 23);
            this.btAcessar.TabIndex = 34;
            this.btAcessar.Text = "Acessar";
            this.btAcessar.UseVisualStyleBackColor = true;
            this.btAcessar.Click += new System.EventHandler(this.btAcessar_Click);
            // 
            // tbsenha
            // 
            this.tbsenha.Location = new System.Drawing.Point(141, 66);
            this.tbsenha.Name = "tbsenha";
            this.tbsenha.PasswordChar = '*';
            this.tbsenha.Size = new System.Drawing.Size(190, 20);
            this.tbsenha.TabIndex = 33;
            // 
            // tblogin
            // 
            this.tblogin.Location = new System.Drawing.Point(141, 40);
            this.tblogin.Name = "tblogin";
            this.tblogin.Size = new System.Drawing.Size(190, 20);
            this.tblogin.TabIndex = 32;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(84, 69);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(41, 13);
            this.label5.TabIndex = 31;
            this.label5.Text = "Senha:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(84, 43);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(36, 13);
            this.label4.TabIndex = 30;
            this.label4.Text = "Login:";
            // 
            // btNovo
            // 
            this.btNovo.Location = new System.Drawing.Point(261, 104);
            this.btNovo.Name = "btNovo";
            this.btNovo.Size = new System.Drawing.Size(70, 23);
            this.btNovo.TabIndex = 36;
            this.btNovo.Text = "Novo";
            this.btNovo.UseVisualStyleBackColor = true;
            this.btNovo.Click += new System.EventHandler(this.btNovo_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(414, 167);
            this.Controls.Add(this.btNovo);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.btAcessar);
            this.Controls.Add(this.tbsenha);
            this.Controls.Add(this.tblogin);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Name = "Form1";
            this.Text = "Form1";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btAcessar;
        private System.Windows.Forms.TextBox tbsenha;
        private System.Windows.Forms.TextBox tblogin;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button btNovo;
    }
}

