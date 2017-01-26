namespace ProjetoIntegrador
{
    partial class cadTipoServico
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
            this.tbNomeServico = new System.Windows.Forms.TextBox();
            this.tbDescServico = new System.Windows.Forms.TextBox();
            this.btSalvarServico = new System.Windows.Forms.Button();
            this.btSairServico = new System.Windows.Forms.Button();
            this.btLimparServico = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(25, 27);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(53, 18);
            this.label1.TabIndex = 9;
            this.label1.Text = "Serviço:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(12, 61);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(66, 18);
            this.label2.TabIndex = 10;
            this.label2.Text = "Descrição:";
            // 
            // tbNomeServico
            // 
            this.tbNomeServico.Location = new System.Drawing.Point(87, 26);
            this.tbNomeServico.Name = "tbNomeServico";
            this.tbNomeServico.Size = new System.Drawing.Size(280, 20);
            this.tbNomeServico.TabIndex = 11;
            // 
            // tbDescServico
            // 
            this.tbDescServico.Location = new System.Drawing.Point(87, 60);
            this.tbDescServico.Multiline = true;
            this.tbDescServico.Name = "tbDescServico";
            this.tbDescServico.Size = new System.Drawing.Size(280, 128);
            this.tbDescServico.TabIndex = 12;
            // 
            // btSalvarServico
            // 
            this.btSalvarServico.Location = new System.Drawing.Point(130, 215);
            this.btSalvarServico.Name = "btSalvarServico";
            this.btSalvarServico.Size = new System.Drawing.Size(75, 23);
            this.btSalvarServico.TabIndex = 13;
            this.btSalvarServico.Text = "Salvar";
            this.btSalvarServico.UseVisualStyleBackColor = true;
            this.btSalvarServico.Click += new System.EventHandler(this.btSalvarServico_Click);
            // 
            // btSairServico
            // 
            this.btSairServico.Location = new System.Drawing.Point(292, 215);
            this.btSairServico.Name = "btSairServico";
            this.btSairServico.Size = new System.Drawing.Size(75, 23);
            this.btSairServico.TabIndex = 14;
            this.btSairServico.Text = "Sair";
            this.btSairServico.UseVisualStyleBackColor = true;
            this.btSairServico.Click += new System.EventHandler(this.btSairServico_Click);
            // 
            // btLimparServico
            // 
            this.btLimparServico.Location = new System.Drawing.Point(211, 215);
            this.btLimparServico.Name = "btLimparServico";
            this.btLimparServico.Size = new System.Drawing.Size(75, 23);
            this.btLimparServico.TabIndex = 15;
            this.btLimparServico.Text = "Limpar";
            this.btLimparServico.UseVisualStyleBackColor = true;
            this.btLimparServico.Click += new System.EventHandler(this.btLimparServico_Click);
            // 
            // cadTipoServico
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(423, 261);
            this.Controls.Add(this.btLimparServico);
            this.Controls.Add(this.btSairServico);
            this.Controls.Add(this.btSalvarServico);
            this.Controls.Add(this.tbDescServico);
            this.Controls.Add(this.tbNomeServico);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "cadTipoServico";
            this.Text = "Cadastrar Tipo de Serviço";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tbNomeServico;
        private System.Windows.Forms.TextBox tbDescServico;
        private System.Windows.Forms.Button btSalvarServico;
        private System.Windows.Forms.Button btSairServico;
        private System.Windows.Forms.Button btLimparServico;
    }
}