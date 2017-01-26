namespace Tra_Va
{
    partial class Form1
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
            this.tbx_login = new System.Windows.Forms.TextBox();
            this.tbx_senha = new System.Windows.Forms.TextBox();
            this.bt_cadastrar = new System.Windows.Forms.Button();
            this.bt_logar = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(59, 49);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(33, 13);
            this.label1.TabIndex = 0;
            this.label1.Text = "Login";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(59, 88);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(38, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "Senha";
            // 
            // tbx_login
            // 
            this.tbx_login.Location = new System.Drawing.Point(145, 49);
            this.tbx_login.Name = "tbx_login";
            this.tbx_login.Size = new System.Drawing.Size(100, 20);
            this.tbx_login.TabIndex = 2;
            // 
            // tbx_senha
            // 
            this.tbx_senha.Location = new System.Drawing.Point(145, 76);
            this.tbx_senha.Name = "tbx_senha";
            this.tbx_senha.Size = new System.Drawing.Size(100, 20);
            this.tbx_senha.TabIndex = 3;
            // 
            // bt_cadastrar
            // 
            this.bt_cadastrar.Location = new System.Drawing.Point(62, 129);
            this.bt_cadastrar.Name = "bt_cadastrar";
            this.bt_cadastrar.Size = new System.Drawing.Size(75, 23);
            this.bt_cadastrar.TabIndex = 4;
            this.bt_cadastrar.Text = "Cadastrar";
            this.bt_cadastrar.UseVisualStyleBackColor = true;
            this.bt_cadastrar.Click += new System.EventHandler(this.bt_cadastrar_Click);
            // 
            // bt_logar
            // 
            this.bt_logar.Location = new System.Drawing.Point(170, 129);
            this.bt_logar.Name = "bt_logar";
            this.bt_logar.Size = new System.Drawing.Size(75, 23);
            this.bt_logar.TabIndex = 5;
            this.bt_logar.Text = "Logar";
            this.bt_logar.UseVisualStyleBackColor = true;
            this.bt_logar.Click += new System.EventHandler(this.bt_logar_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(298, 208);
            this.Controls.Add(this.bt_logar);
            this.Controls.Add(this.bt_cadastrar);
            this.Controls.Add(this.tbx_senha);
            this.Controls.Add(this.tbx_login);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Form1";
            this.Text = "Login";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbx_login;
        private System.Windows.Forms.TextBox tbx_senha;
        private System.Windows.Forms.Button bt_cadastrar;
        private System.Windows.Forms.Button bt_logar;
    }
}

