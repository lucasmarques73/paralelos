namespace aula_21_08_Enquete_Festa
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
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.btFechar = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btSalvar = new System.Windows.Forms.Button();
            this.btResultado = new System.Windows.Forms.Button();
            this.rbDataOp1 = new System.Windows.Forms.RadioButton();
            this.rbDataOp2 = new System.Windows.Forms.RadioButton();
            this.rbDataOp3 = new System.Windows.Forms.RadioButton();
            this.rbDataOp4 = new System.Windows.Forms.RadioButton();
            this.rbLocalOp1 = new System.Windows.Forms.RadioButton();
            this.rbLocalOp2 = new System.Windows.Forms.RadioButton();
            this.rbLocalOp3 = new System.Windows.Forms.RadioButton();
            this.rbLocalOp4 = new System.Windows.Forms.RadioButton();
            this.gbData = new System.Windows.Forms.GroupBox();
            this.gbLocal = new System.Windows.Forms.GroupBox();
            this.gbData.SuspendLayout();
            this.gbLocal.SuspendLayout();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(28, 9);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(215, 20);
            this.label1.TabIndex = 0;
            this.label1.Text = "Qual melhor data para festa?";
            this.label1.Click += new System.EventHandler(this.label1_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(28, 160);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(139, 20);
            this.label2.TabIndex = 1;
            this.label2.Text = "Qual melhor local?";
            this.label2.Click += new System.EventHandler(this.label2_Click);
            // 
            // btFechar
            // 
            this.btFechar.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btFechar.Location = new System.Drawing.Point(255, 291);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 18;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = true;
            this.btFechar.Click += new System.EventHandler(this.btFechar_Click);
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(93, 291);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 17;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btSalvar
            // 
            this.btSalvar.BackColor = System.Drawing.Color.Transparent;
            this.btSalvar.Location = new System.Drawing.Point(12, 291);
            this.btSalvar.Name = "btSalvar";
            this.btSalvar.Size = new System.Drawing.Size(75, 23);
            this.btSalvar.TabIndex = 16;
            this.btSalvar.Text = "Salvar";
            this.btSalvar.UseVisualStyleBackColor = false;
            this.btSalvar.Click += new System.EventHandler(this.btSalvar_Click);
            // 
            // btResultado
            // 
            this.btResultado.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btResultado.Location = new System.Drawing.Point(174, 291);
            this.btResultado.Name = "btResultado";
            this.btResultado.Size = new System.Drawing.Size(75, 23);
            this.btResultado.TabIndex = 19;
            this.btResultado.Text = "Resultado";
            this.btResultado.UseVisualStyleBackColor = true;
            this.btResultado.Click += new System.EventHandler(this.btResultado_Click);
            // 
            // rbDataOp1
            // 
            this.rbDataOp1.AutoSize = true;
            this.rbDataOp1.Location = new System.Drawing.Point(6, 19);
            this.rbDataOp1.Name = "rbDataOp1";
            this.rbDataOp1.Size = new System.Drawing.Size(83, 17);
            this.rbDataOp1.TabIndex = 20;
            this.rbDataOp1.TabStop = true;
            this.rbDataOp1.Text = "23/08/2014";
            this.rbDataOp1.UseVisualStyleBackColor = true;
            // 
            // rbDataOp2
            // 
            this.rbDataOp2.AutoSize = true;
            this.rbDataOp2.Location = new System.Drawing.Point(6, 42);
            this.rbDataOp2.Name = "rbDataOp2";
            this.rbDataOp2.Size = new System.Drawing.Size(83, 17);
            this.rbDataOp2.TabIndex = 21;
            this.rbDataOp2.TabStop = true;
            this.rbDataOp2.Text = "30/08/2014";
            this.rbDataOp2.UseVisualStyleBackColor = true;
            // 
            // rbDataOp3
            // 
            this.rbDataOp3.AutoSize = true;
            this.rbDataOp3.Location = new System.Drawing.Point(6, 65);
            this.rbDataOp3.Name = "rbDataOp3";
            this.rbDataOp3.Size = new System.Drawing.Size(83, 17);
            this.rbDataOp3.TabIndex = 22;
            this.rbDataOp3.TabStop = true;
            this.rbDataOp3.Text = "06/09/2014";
            this.rbDataOp3.UseVisualStyleBackColor = true;
            // 
            // rbDataOp4
            // 
            this.rbDataOp4.AutoSize = true;
            this.rbDataOp4.Location = new System.Drawing.Point(6, 88);
            this.rbDataOp4.Name = "rbDataOp4";
            this.rbDataOp4.Size = new System.Drawing.Size(83, 17);
            this.rbDataOp4.TabIndex = 23;
            this.rbDataOp4.TabStop = true;
            this.rbDataOp4.Text = "13/09/2014";
            this.rbDataOp4.UseVisualStyleBackColor = true;
            // 
            // rbLocalOp1
            // 
            this.rbLocalOp1.AutoSize = true;
            this.rbLocalOp1.Location = new System.Drawing.Point(6, 12);
            this.rbLocalOp1.Name = "rbLocalOp1";
            this.rbLocalOp1.Size = new System.Drawing.Size(52, 17);
            this.rbLocalOp1.TabIndex = 24;
            this.rbLocalOp1.TabStop = true;
            this.rbLocalOp1.Text = "Aloha";
            this.rbLocalOp1.UseVisualStyleBackColor = true;
            // 
            // rbLocalOp2
            // 
            this.rbLocalOp2.AutoSize = true;
            this.rbLocalOp2.Location = new System.Drawing.Point(6, 35);
            this.rbLocalOp2.Name = "rbLocalOp2";
            this.rbLocalOp2.Size = new System.Drawing.Size(67, 17);
            this.rbLocalOp2.TabIndex = 25;
            this.rbLocalOp2.TabStop = true;
            this.rbLocalOp2.Text = "Barbaros";
            this.rbLocalOp2.UseVisualStyleBackColor = true;
            // 
            // rbLocalOp3
            // 
            this.rbLocalOp3.AutoSize = true;
            this.rbLocalOp3.Location = new System.Drawing.Point(6, 58);
            this.rbLocalOp3.Name = "rbLocalOp3";
            this.rbLocalOp3.Size = new System.Drawing.Size(52, 17);
            this.rbLocalOp3.TabIndex = 26;
            this.rbLocalOp3.TabStop = true;
            this.rbLocalOp3.Text = "Eurus";
            this.rbLocalOp3.UseVisualStyleBackColor = true;
            // 
            // rbLocalOp4
            // 
            this.rbLocalOp4.AutoSize = true;
            this.rbLocalOp4.Location = new System.Drawing.Point(6, 81);
            this.rbLocalOp4.Name = "rbLocalOp4";
            this.rbLocalOp4.Size = new System.Drawing.Size(64, 17);
            this.rbLocalOp4.TabIndex = 27;
            this.rbLocalOp4.TabStop = true;
            this.rbLocalOp4.Text = "Estação";
            this.rbLocalOp4.UseVisualStyleBackColor = true;
            // 
            // gbData
            // 
            this.gbData.BackColor = System.Drawing.Color.Transparent;
            this.gbData.Controls.Add(this.rbDataOp1);
            this.gbData.Controls.Add(this.rbDataOp2);
            this.gbData.Controls.Add(this.rbDataOp3);
            this.gbData.Controls.Add(this.rbDataOp4);
            this.gbData.Location = new System.Drawing.Point(32, 32);
            this.gbData.Name = "gbData";
            this.gbData.Size = new System.Drawing.Size(200, 121);
            this.gbData.TabIndex = 28;
            this.gbData.TabStop = false;
            // 
            // gbLocal
            // 
            this.gbLocal.Controls.Add(this.rbLocalOp2);
            this.gbLocal.Controls.Add(this.rbLocalOp1);
            this.gbLocal.Controls.Add(this.rbLocalOp4);
            this.gbLocal.Controls.Add(this.rbLocalOp3);
            this.gbLocal.Location = new System.Drawing.Point(32, 183);
            this.gbLocal.Name = "gbLocal";
            this.gbLocal.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.gbLocal.Size = new System.Drawing.Size(200, 100);
            this.gbLocal.TabIndex = 29;
            this.gbLocal.TabStop = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.LightYellow;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.ClientSize = new System.Drawing.Size(350, 333);
            this.Controls.Add(this.gbLocal);
            this.Controls.Add(this.gbData);
            this.Controls.Add(this.btResultado);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvar);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Cursor = System.Windows.Forms.Cursors.Hand;
            this.Name = "Form1";
            this.Text = "Enquete Festa";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.gbData.ResumeLayout(false);
            this.gbData.PerformLayout();
            this.gbLocal.ResumeLayout(false);
            this.gbLocal.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button btFechar;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btSalvar;
        private System.Windows.Forms.Button btResultado;
        private System.Windows.Forms.RadioButton rbDataOp1;
        private System.Windows.Forms.RadioButton rbDataOp2;
        private System.Windows.Forms.RadioButton rbDataOp3;
        private System.Windows.Forms.RadioButton rbDataOp4;
        private System.Windows.Forms.RadioButton rbLocalOp1;
        private System.Windows.Forms.RadioButton rbLocalOp2;
        private System.Windows.Forms.RadioButton rbLocalOp3;
        private System.Windows.Forms.RadioButton rbLocalOp4;
        private System.Windows.Forms.GroupBox gbData;
        private System.Windows.Forms.GroupBox gbLocal;
    }
}

