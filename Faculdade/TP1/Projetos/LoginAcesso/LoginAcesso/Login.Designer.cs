namespace LoginAcesso
{
    partial class Login
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
            this.tbsenha = new System.Windows.Forms.TextBox();
            this.tblogin = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.btSair = new System.Windows.Forms.Button();
            this.btAcessar = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // tbsenha
            // 
            this.tbsenha.Location = new System.Drawing.Point(111, 71);
            this.tbsenha.Name = "tbsenha";
            this.tbsenha.PasswordChar = '*';
            this.tbsenha.Size = new System.Drawing.Size(190, 20);
            this.tbsenha.TabIndex = 26;
            // 
            // tblogin
            // 
            this.tblogin.Location = new System.Drawing.Point(111, 45);
            this.tblogin.Name = "tblogin";
            this.tblogin.Size = new System.Drawing.Size(190, 20);
            this.tblogin.TabIndex = 25;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(54, 74);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(41, 13);
            this.label5.TabIndex = 24;
            this.label5.Text = "Senha:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(54, 48);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(36, 13);
            this.label4.TabIndex = 23;
            this.label4.Text = "Login:";
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(206, 109);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 29;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btAcessar
            // 
            this.btAcessar.Location = new System.Drawing.Point(125, 109);
            this.btAcessar.Name = "btAcessar";
            this.btAcessar.Size = new System.Drawing.Size(75, 23);
            this.btAcessar.TabIndex = 28;
            this.btAcessar.Text = "Acessar";
            this.btAcessar.UseVisualStyleBackColor = true;
            this.btAcessar.Click += new System.EventHandler(this.btAcessar_Click);
            // 
            // Login
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(373, 195);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.btAcessar);
            this.Controls.Add(this.tbsenha);
            this.Controls.Add(this.tblogin);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Name = "Login";
            this.Text = "Login";
            this.FormClosed += new System.Windows.Forms.FormClosedEventHandler(this.Login_FormClosed);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tbsenha;
        private System.Windows.Forms.TextBox tblogin;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btAcessar;
    }
}